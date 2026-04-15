<?php

namespace App\Filament\Admin\Resources\ClientRequests\Pages;

use App\Filament\Admin\Resources\ClientRequests\ClientRequestResource;
use Filament\Resources\Pages\CreateRecord;

class CreateClientRequest extends CreateRecord
{
    protected static string $resource = ClientRequestResource::class;

    protected function mutateFormDataBeforeCreate (array $data): array {
        $data['status'] = $data['status'] ?? 'pending';
        $data['status_changed_at'] = now();

        return $data;
    }
}
