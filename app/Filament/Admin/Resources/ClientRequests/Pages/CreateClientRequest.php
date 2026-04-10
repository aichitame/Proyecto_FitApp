<?php

namespace App\Filament\Admin\Resources\ClientRequests\Pages;

use App\Filament\Admin\Resources\ClientRequests\ClientRequestResource;
use Filament\Resources\Pages\CreateRecord;

class CreateClientRequest extends CreateRecord
{
    protected static string $resource = ClientRequestResource::class;
}
