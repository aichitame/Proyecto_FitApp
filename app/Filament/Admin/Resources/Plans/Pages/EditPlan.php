<?php

namespace App\Filament\Admin\Resources\Plans\Pages;

use App\Filament\Admin\Resources\Plans\PlanResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPlan extends EditRecord
{
    protected static string $resource = PlanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()
            ->before(function ($record) {
                //con 'before' accedemos a la relación antes de que el plan
                //desaparezca de la base de datos
                if($record->clientRequest){
                    $record->clientRequest->update([
                        'status' => 'pending',
                    ]);
                }
            }),
        ];
    }
}
