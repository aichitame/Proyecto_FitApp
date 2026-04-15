<?php

use App\Mail\PlanAvailableMail;
use App\Models\RequestNotification;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('notifications:send-plan-available', function () {
$pendingNotifications = RequestNotification::query()
->where('type', 'plan_available')
->where('status', 'pending')
->with([
    'clientRequest.user',
    'clientRequest.plans' => fn ($query) => $query
    ->where('status', 'published')
    ->orderByDesc('version'),
])
->get();

if ($pendingNotifications->isEmpty()){
    $this->info('No hay notificaciones pendientes.');
    return;
}

foreach ($pendingNotifications as $notification){
    /** @var \App\Models\RequestNotification $notification */
    try{
        $clientRequest = $notification->clientRequest;
        $user = $clientRequest?->user;
        $plan = $clientRequest?->plans?->first();

        if (! $clientRequest || ! $user || ! $user->email || ! $plan){
            $notification->update([
                'status' => 'failed',
                'attempts' => $notification->attempts + 1,
                'error_message' => 'Faltan datos para enviar la notificación.',
            ]);

            $this->error("Notificación {$notification->id}: faltan datos para el envío.");
            continue;
        }

        Mail::to($user->email)->send(
            new PlanAvailableMail($clientRequest, $plan)
        );

        $notification->update([
            'status' => 'sent',
            'notified_at' => now(),
            'attempts' => $notification->attempts + 1,
            'error_message' => null,
        ]);

        $this->info("Notificación {$notification->id} enviada a {$user->mail}");
    } catch (\Throwable $e){
        $notification->update([
            'status' => 'failed',
            'attempts' => $notification->attempts + 1,
            'error_message' => $e->getMessage(),
        ]);

        $this->error("Error en la notificación {$notification->id}: {$e->getMessage()}");
    }
}
})->purpose('Enviar notificaciones pendientes de planes publicados');
