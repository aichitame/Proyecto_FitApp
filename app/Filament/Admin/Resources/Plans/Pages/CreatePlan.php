<?php

namespace App\Filament\Admin\Resources\Plans\Pages;

use App\Filament\Admin\Resources\Plans\PlanResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePlan extends CreateRecord
{
    protected static string $resource = PlanResource::class;

    /**
     * Este método se ejecuta después de que el plan se haya creado 
     * en la base de datos
     */

    protected function afterCreate(): void {
        //1. vamos a obtener el plan que se acaba de crear
        $plan = $this->record;

        //2. vamos a acceder a la solicitud relacionada (clientRequest)
        //y actualizamos su estado a "completed"
        $plan->clientRequest()->update([
            'status' => 'completed',
        ]);
    }
}
