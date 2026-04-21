<?php

use App\Models\Plan;
use App\Models\ClientRequest;
use App\Mail\PlanAvailableMail;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Client\RequestWizard;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;

Route::get('/test-send-plan-mail', function () {
    $clientRequest = ClientRequest::with('user')->first();
    $plan = Plan::first();

    dd([
        'clientRequest_exists' => (bool) $clientRequest,
        'user_exists' => (bool) $clientRequest?->user,
        'user_email' => $clientRequest?->user?->email,
        'plan_exists' => (bool) $plan,
    ]);
});

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('/vision', 'vision')->name('vision');
Route::view('/como-funciona', 'como-funciona')->name('como-funciona');
Route::view('/contacto', 'contacto')->name('contacto');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');

    Route::get('/request/new', RequestWizard::class)
        ->name('client.requests.create');
    
    Route::view('request/sent', 'client.request-sent')
    ->name('client.requests.sent');
});

require __DIR__.'/auth.php';
