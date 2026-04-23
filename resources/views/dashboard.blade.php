@vite('resources/css/dashboard.css')

@extends('layouts.public')

@section('content')
    <section class="client-panel">
        <div class="client-panel-header">
            <p class="client-panel-eyebrow">Área privada de cliente</p>
            <h1 class="client-panel-title">Hola, {{ auth()->user()->name }}</h1>
            <p class="client-panel-subtitle">
                Desde aquí puedes gestionar tu perfil, crear tu solicitud y acceder a la configuración de tu cuenta.
            </p>
        </div>

        <section class="client-panel-grid">
            <article class="client-panel-card">
                <h2>Ver mis datos</h2>
                <p>Consulta y actualiza tu información personal.</p>

                <a href="{{ route('settings.profile') }}" class="landing-button landing-button-primary">
                    Ver mis datos
                </a>
            </article>

            <article class="client-panel-card">
                <h2>Crear solicitud</h2>
                <p>Completa tu valoración inicial paso a paso.</p>

                <a href="{{ route('client.requests.create') }}" class="landing-button landing-button-primary">
                    Crear solicitud
                </a>
            </article>

            <article class="client-panel-card">
                <h2>Ajustes</h2>
                <p>Gestiona contraseña y preferencias de la cuenta.</p>

                <div class="client-panel-actions">
                    <a href="{{ route('settings.password') }}" class="landing-button landing-button-secondary">
                        Contraseña
                    </a>

                    <a href="{{ route('settings.appearance') }}" class="landing-button landing-button-secondary">
                        Apariencia
                    </a>
                </div>
            </article>

            <article class="client-panel-card client-panel-card-danger">
                <h2>Cerrar sesión</h2>
                <p>Salir de tu cuenta de cliente.</p>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="landing-button landing-button-secondary">
                        Cerrar sesión
                    </button>
                </form>
            </article>
        </section>
    </section>
@endsection