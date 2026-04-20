<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.head')
    </head>
    <body class="auth-page">
        <div class="auth-layout">
            <div class="auth-panel-left">
                <div class="auth-panel-left-content">
                    <a href="{{ route('home') }}" class="auth-desktop-brand" wire:navigate>
                        <x-app-logo-icon class="h-8 w-8 fill-current text-gray-900" />
                        <span class="auth-desktop-brand-text">FitApp</span>
                    </a>

                    <div style="margin-top: 64px;">
                        <p class="auth-kicker">Planificación nutricional y deportiva orientativa</p>

                        <h1 class="auth-title">
                            Cuida tus hábitos con una orientación clara y personalizada.
                        </h1>

                        <p class="auth-text">
                            Accede a tu área privada para solicitar tu valoración inicial, consultar el estado de tu solicitud y recibir tu plan orientativo de forma sencilla.
                        </p>
                    </div>
                </div>

                <div class="auth-info-box">
                    <p class="auth-info-box-title">FitApp</p>
                    <p class="auth-info-box-text">
                        Un espacio pensado para que clientes y profesionales trabajen de forma ordenada, cercana y realista.
                    </p>
                </div>
            </div>

            <div class="auth-panel-right">
                <div class="auth-card">
                    <a href="{{ route('home') }}" class="auth-mobile-brand" wire:navigate>
                        <x-app-logo-icon class="h-8 w-8 fill-current text-gray-900" />
                        <span class="auth-mobile-brand-text">FitApp</span>
                    </a>

                    {{ $slot }}
                </div>
            </div>
        </div>

        @fluxScripts
    </body>
</html>