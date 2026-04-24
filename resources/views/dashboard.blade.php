@vite('resources/css/dashboard.css')

@extends('layouts.public')

@section('content')
    <section class="client-panel">
        <div class="client-panel-header">
            <p class="client-panel-eyebrow">Área privada de cliente</p>

            <div class="client-panel-topbar">
                <h1 class="client-panel-title">
                    Hola, {{ auth()->user()->name }}
                </h1>

                <div class="client-panel-header-actions">
                    <a href="{{ route('settings.profile') }}" class="landing-button landing-button-secondary">
                        Configuración
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="landing-button landing-button-secondary">
                            Cerrar sesión
                        </button>
                    </form>
                </div>
            </div>

            <p class="client-panel-subtitle client-panel-subtitle-full">
                Desde aquí puedes gestionar tu perfil, acceder a la configuración de tu cuenta y realizar tu solicitud
                de valoración inicial.
            </p>
        </div>

        <section class="client-panel-status-card">
            <div class="client-panel-status-header">
                <div>
                    <p class="client-panel-status-eyebrow">Estado actual</p>
                    <h2 class="client-panel-status-title">Mi solicitud</h2>
                </div>

                @if ($clientRequest)
                    <span class="client-status-badge client-status-badge-{{ $clientRequest->status }}">
                        @switch($clientRequest->status)
                            @case('pending')
                                Pendiente
                                @break
                            @case('in_review')
                                En revisión
                                @break
                            @case('completed')
                                Completada
                                @break
                            @case('rejected')
                                Rechazada
                                @break
                            @default
                                {{ $clientRequest->status }}
                        @endswitch
                    </span>
                @else
                    <span class="client-status-badge client-status-badge-empty">
                        Sin solicitud
                    </span>
                @endif
            </div>

            <div class="client-panel-status-body">
                @if (! $clientRequest)
                    <p>
                        Todavía no has enviado ninguna solicitud. Cuando quieras, puedes comenzar tu valoración inicial desde aquí.
                    </p>

                    <a href="{{ route('client.requests.create') }}" class="landing-button landing-button-primary">
                        Crear solicitud
                    </a>
                @elseif ($clientRequest->status === 'pending')
                    <p>
                        Tu solicitud ha sido enviada correctamente y está pendiente de revisión por parte del equipo.
                    </p>
                @elseif ($clientRequest->status === 'in_review')
                    <p>
                        Tu solicitud está en revisión. El equipo está preparando tu plan orientativo.
                    </p>
                @elseif ($clientRequest->status === 'completed')
                    <p>
                        Tu solicitud ya ha sido completada y tu plan orientativo debería estar disponible en tu área privada.
                    </p>

                    <a href="{{ route('client.plan.show') }}" class="landing-button landing-button-primary">
                        Ver mi plan
                    </a>
                @elseif ($clientRequest->status === 'rejected')
                    <p>
                        Tu solicitud no ha podido continuar. Revisa el motivo indicado por el equipo si está disponible.
                    </p>

                    @if ($clientRequest->rejection_reason)
                        <div class="client-panel-status-note">
                            <strong>Motivo:</strong> {{ $clientRequest->rejection_reason }}
                        </div>
                    @endif
                @endif
            </div>
        </section>

        <section class="client-panel-grid client-panel-grid-simple">
            <article class="client-panel-card">
                <h2>Mis datos</h2>
                <p>Consulta y actualiza tu información personal.</p>

                <a href="{{ route('settings.profile') }}" class="landing-button landing-button-primary">
                    Ver mis datos
                </a>
            </article>

            <article class="client-panel-card">
                <h2>Nueva solicitud</h2>
                <p>Inicia tu valoración inicial y completa el formulario paso a paso.</p>

                <a href="{{ route('client.requests.create') }}" class="landing-button landing-button-primary">
                    Crear solicitud
                </a>
            </article>
        </section>
    </section>
@endsection