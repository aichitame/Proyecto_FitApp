<?php

namespace App\Filament\Admin\Resources\ClientRequests\Pages;

use App\Filament\Admin\Resources\ClientRequests\ClientRequestResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditClientRequest extends EditRecord
{
    protected static string $resource = ClientRequestResource::class;

    protected function mutateFormDataBeforeSave(array $data): array {
        if (in_array(($data['status'] ?? null), ['pending', 'in_review', 'completed', 'rejected'], true)) {
            $data['status_changed_at'] = now();
        }

        return $data;
    }
    
    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
