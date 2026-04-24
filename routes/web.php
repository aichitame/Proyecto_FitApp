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
use Illuminate\Support\Facades\Auth;


Route::redirect('/acceso-admin', '/admin')->name('admin.login');

Route::get('/test-send-plan-mail', function () {
    $clientRequest = ClientRequest::with('user')->first();
    $plan = Plan::first();

    Mail::to($clientRequest->user->email)->send(
        new PlanAvailableMail($clientRequest, $plan)
    );

    dd('correo enviado correctamente');
});

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('/vision', 'vision')->name('vision');
Route::view('/como-funciona', 'como-funciona')->name('como-funciona');
Route::view('/contacto', 'contacto')->name('contacto');

Route::get('dashboard', function () {
    if (Auth::user()?->role === 'admin'){
        return redirect ('/admin');
    }

    $clientRequest = ClientRequest::query()
    ->where('user_id', Auth::id())
    ->latest()
    ->first();

    return view ('dashboard', [
        'clientRequest' => $clientRequest,
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
    Route::get('/mi-plan', function (){
        $clientRequest = ClientRequest::query()
            ->where('user_id', Auth::id())
            ->where('status', 'completed')
            ->latest()
            ->first();

        if(! $clientRequest){
            abort(404);
        }

        $plan = $clientRequest->plans()
            ->where('status', 'published')
            ->latest('published_at')
            ->first();

        if(! $plan){
            abort(404);
        }

        return view('client.plan-show', [
            'clientRequest' => $clientRequest,
            'plan' => $plan,
        ]);
    })->name('client.plan.show');

    Route::get('/request/new', RequestWizard::class)
        ->name('client.requests.create');
    
    Route::view('request/sent', 'client.request-sent')
    ->name('client.requests.sent');
});

require __DIR__.'/auth.php';
