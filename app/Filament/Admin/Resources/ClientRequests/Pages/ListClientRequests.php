<?php

namespace App\Filament\Admin\Resources\ClientRequests\Pages;

use App\Filament\Admin\Resources\ClientRequests\ClientRequestResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListClientRequests extends ListRecords
{
    protected static string $resource = ClientRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
