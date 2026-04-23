<?php

namespace App\Filament\Admin\Resources\Plans\Pages;

use App\Filament\Admin\Resources\Plans\PlanResource;
use App\Mail\PlanAvailableMail;
use App\Models\Plan;
use App\Models\RequestNotification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;


class CreatePlan extends CreateRecord
{
    protected static string $resource = PlanResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array{
        $data['user_id'] = Auth::id();

        $lastVersion = Plan::query()
        ->where('client_request_id', $data['client_request_id'])
        ->max('version');

        $data['version'] = $lastVersion ? $lastVersion + 1 : 1;

        if(($data['status'] ?? 'draft') === 'published'){
            $data['published_at'] = now();
        }else{
            $data['published_at'] = null;
        }

        return $data;
    }

    protected function afterCreate(): void {
        $plan = $this->record;
        $clientRequest = $plan->clientRequest;

        if (!$clientRequest) {
            return;
        }

        if($plan->status === 'published'){
            $clientRequest->update([
                'status' => 'completed',
                'status_changed_at' => now(),
            ]);

            try {
                Mail::to($clientRequest->user->email)
                ->send(new PlanAvailableMail($clientRequest, $plan));

                RequestNotification::create([
                    'client_request_id' => $clientRequest->id,
                    'type' => 'plan_available',
                    'status' => 'sent',
                    'notified_at' => now(),
                    'attempts' => 1,
                    'error_message' => null,
                    'sent_by_user_id' => Auth::id(),
                ]);
            } catch (\Throwable $e){
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
            $clientRequest->update([
                'status' => 'in_review',
                'status_changed_at' => now(),
            ]);
        }
    }
}
