<?php

namespace App\Filament\Admin\Resources\Plans\Pages;

use App\Filament\Admin\Resources\Plans\PlanResource;
use App\Mail\PlanAvailableMail;
use App\Models\ClientRequest;
use App\Models\RequestNotification;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class EditPlan extends EditRecord
{
    protected static string $resource = PlanResource::class;

    protected bool $wasPublished = false;

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $this->wasPublished = $this->record->status === 'published';

        $data['user_id'] = Auth::id();

        if (($data['status'] ?? 'draft') === 'published') {
            if (blank($this->record->published_at)) {
                $data['published_at'] = now();
            }
        } else {
            $data['published_at'] = null;
        }

        return $data;
    }

    protected function afterSave(): void
{
    $plan = $this->record->refresh();
    $clientRequest = $plan->clientRequest;

    $this->updateClientRequestStatus($clientRequest);

    Log::info('DEBUG envio plan - despues de guardar', [
        'plan_id' => $plan->id,
        'plan_status' => $plan->status,
        'was_published' => $this->wasPublished,
        'client_request_id' => $clientRequest?->id,
        'client_email' => $clientRequest?->user?->email,
    ]);

    if (
        $clientRequest &&
        ! $this->wasPublished &&
        $plan->status === 'published'
    ) {
        Log::info('DEBUG envio plan - entra en condicion de envio', [
            'plan_id' => $plan->id,
            'client_request_id' => $clientRequest->id,
            'email' => $clientRequest->user?->email,
        ]);

        try {
            Mail::to($clientRequest->user->email)
                ->send(new PlanAvailableMail($clientRequest, $plan));

            Log::info('DEBUG envio plan - correo enviado correctamente', [
                'plan_id' => $plan->id,
                'email' => $clientRequest->user?->email,
            ]);

            RequestNotification::create([
                'client_request_id' => $clientRequest->id,
                'type' => 'plan_available',
                'status' => 'sent',
                'notified_at' => now(),
                'attempts' => 1,
                'error_message' => null,
                'sent_by_user_id' => Auth::id(),
            ]);
        } catch (\Throwable $e) {
            Log::error('DEBUG envio plan - error al enviar correo', [
                'client_request_id' => $clientRequest->id,
                'plan_id' => $plan->id,
                'email' => $clientRequest->user?->email,
                'error' => $e->getMessage(),
            ]);

            RequestNotification::create([
                'client_request_id' => $clientRequest->id,
                'type' => 'plan_available',
                'status' => 'failed',
                'notified_at' => null,
                'attempts' => 1,
                'error_message' => $e->getMessage(),
                'sent_by_user_id' => Auth::id(),
            ]);
        }
    } else {
        Log::info('DEBUG envio plan - NO entra en condicion de envio', [
            'client_request_exists' => (bool) $clientRequest,
            'was_published' => $this->wasPublished,
            'plan_status' => $plan->status,
        ]);
    }
}

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()
                ->before(function ($record) {
                    $this->updateClientRequestStatus($record->clientRequest, $record->id);
                }),
        ];
    }

    private function updateClientRequestStatus(?ClientRequest $clientRequest, ?int $excludePlanId = null): void
    {
        if (! $clientRequest) {
            return;
        }

        if ($clientRequest->status === 'rejected') {
            return;
        }

        $plansQuery = $clientRequest->plans();

        if ($excludePlanId !== null) {
            $plansQuery->where('id', '!=', $excludePlanId);
        }

        $hasPublishedPlans = (clone $plansQuery)
            ->where('status', 'published')
            ->exists();

        $hasDraftPlans = (clone $plansQuery)
            ->where('status', 'draft')
            ->exists();

        if ($hasPublishedPlans) {
            $clientRequest->update([
                'status' => 'completed',
                'status_changed_at' => now(),
            ]);

            return;
        }

        if ($hasDraftPlans) {
            $clientRequest->update([
                'status' => 'in_review',
                'status_changed_at' => now(),
            ]);

            return;
        }

        $clientRequest->update([
            'status' => 'pending',
            'status_changed_at' => now(),
        ]);
    }
}