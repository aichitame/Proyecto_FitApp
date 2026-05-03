<?php

namespace App\Filament\Admin\Resources\Plans\Pages;

use App\Filament\Admin\Resources\Plans\PlanResource;
use App\Models\Plan;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreatePlan extends CreateRecord
{
    protected static string $resource = PlanResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = Auth::id();

        $lastVersion = Plan::query()
            ->where('client_request_id', $data['client_request_id'])
            ->max('version');

        $data['version'] = $lastVersion ? $lastVersion + 1 : 1;

        if (($data['status'] ?? 'draft') === 'published') {
            $data['published_at'] = now();
        } else {
            $data['published_at'] = null;
        }

        return $data;
    }

    protected function afterCreate(): void
    {
        $plan = $this->record;
        $clientRequest = $plan->clientRequest;

        if (! $clientRequest) {
            return;
        }

        if ($plan->status === 'published') {
            $clientRequest->update([
                'status' => 'completed',
                'status_changed_at' => now(),
            ]);

            return;
        }

        $clientRequest->update([
            'status' => 'in_review',
            'status_changed_at' => now(),
        ]);
    }
}