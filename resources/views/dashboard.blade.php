@extends('layouts.public')

@php
    $hasActiveRequest = $clientRequest
        && in_array($clientRequest->status, ['pending', 'in_review'], true);
@endphp

@section('header_actions')
    <div class="client-header-actions">
        <a href="{{ route('settings.profile') }}" class="landing-button landing-button-secondary client-header-link">
            Configuración
        </a>

        <form method="POST" action="{{ route('logout') }}" class="client-header-logout-form">
            @csrf

            <button type="submit" class="landing-button landing-button-secondary client-header-link">
                Cerrar sesión
            </button>
        </form>
    </div>
@endsection

@section('content')
    <section class="client-panel">
        <div class="client-panel-header">
            <p class="client-panel-eyebrow">Área privada de cliente</p>

            <div class="client-panel-topbar">
                <h1 class="client-panel-title">
                    Hola, {{ auth()->user()->name }}
                </h1>

            <details class="client-hero-menu">
    <summary class="client-hero-menu-button">
        <span class="client-hero-menu-icon" aria-hidden="true">
            <span></span>
            <span></span>
            <span></span>
        </span>

        <span>Menú</span>
    </summary>

    <div class="client-hero-menu-panel client-hero-menu-panel-large">
        <div class="client-hero-menu-grid">
            <a href="#solicitud"
            class="client-hero-menu-card"
            onclick="this.closest('details').removeAttribute('open')">
                <span>Estado actual</span>
                <strong>Mi solicitud</strong>
                <small>Consulta el estado y la información principal de tu solicitud.</small>
            </a>
            @if ($clientRequest && $clientRequest->status === 'completed')
            <a href="{{ route('client.plan.show', ['requestId' => $clientRequest->id]) }}"
            class="client-hero-menu-card"
            onclick="this.closest('details').removeAttribute('open')">
                <span>Plan publicado</span>
                    <strong>Mi plan</strong>
                        <small>Accede al último plan orientativo disponible.</small>
                </a>
            @else
                <a href="#solicitud"
        class="client-hero-menu-card"
        onclick="this.closest('details').removeAttribute('open')">
        <span>Plan orientativo</span>
        <strong>Mi plan</strong>
        <small>Estará disponible cuando tu solicitud esté completada.</small>
    </a>
@endif

            <a href="{{ route('settings.profile') }}"
            class="client-hero-menu-card"
            onclick="this.closest('details').removeAttribute('open')">
                <span>Perfil</span>
                <strong>Mis datos</strong>
                <small>Consulta y actualiza tu información personal.</small>
            </a>

            @if (! $hasActiveRequest)
                <a href="{{ route('client.requests.create') }}"
                class="client-hero-menu-card"
                onclick="this.closest('details').removeAttribute('open')">
                    <span>Nueva solicitud</span>
                        <strong>Crear nueva solicitud</strong>
                            <small>Completa de nuevo el formulario de valoración inicial.</small>
                </a>
            @endif

            @if ($clientRequests->count() > 1)
                <a href="#historial"
                class="client-hero-menu-card"
                onclick="this.closest('details').removeAttribute('open')">
                    <span>Histórico</span>
                    <strong>Solicitudes anteriores</strong>
                    <small>Revisa solicitudes pasadas y planes publicados.</small>
                </a>
            @endif
        </div>
    </div>
</details>
            </div>

            <p class="client-panel-subtitle client-panel-subtitle-full">
                Desde aquí puedes consultar el estado de tu solicitud, acceder a tus planes orientativos
                y gestionar tu información personal.
            </p>
        </div>

        <section id="solicitud" class="client-panel-status-card">
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
                @if ($clientRequest)
                    <div class="client-panel-status-meta">
                        <p><strong>Fecha de envío:</strong>
                            {{ $clientRequest->created_at?->format('d/m/Y H:i') }}</p>
                        <p><strong>Último cambio de estado:</strong>
                            {{ $clientRequest->status_changed_at?->format('d/m/Y H:i') ?? '-' }}</p>
                    </div>
                @endif

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
                        Tu solicitud ya ha sido completada y tu plan orientativo está disponible en tu área privada.
                    </p>

                    <a href="{{ route('client.plan.show', ['requestId' => $clientRequest->id]) }}"
                    class="landing-button landing-button-primary">
                        Ver mi plan
                    </a>
                @elseif ($clientRequest->status === 'rejected')
                    <p>
                    Tu solicitud no ha podido continuar. Revisa el motivo indicado por el equipo si está disponible.</p>

                @if ($clientRequest->rejection_reason)
                    <div class="client-panel-status-note">
                        <strong>Motivo:</strong> {{ $clientRequest->rejection_reason }}
                    </div>
                @endif

    <div class="client-panel-status-actions">
        <a href="{{ route('client.requests.create') }}" class="landing-button landing-button-primary">
            Crear nueva solicitud
        </a>
    </div>
@endif
            </div>
        </section>

        @if ($clientRequests->count() > 1)
            <section id="historial" class="client-panel-history">
                <div class="client-panel-history-header">
                    <p class="client-panel-status-eyebrow">Histórico</p>
                    <h2 class="client-panel-status-title">Solicitudes anteriores</h2>
                    <p class="client-panel-history-intro">
                        Consulta tus solicitudes anteriores y el último plan publicado asociado a cada una.
                    </p>
                </div>

                <div class="client-panel-history-list">
                    @foreach ($clientRequests->skip(1) as $request)
                        @php
                            $publishedPlan = $request->plans->first();
                        @endphp

                        <article class="client-panel-history-item">
                            <div class="client-panel-history-top">
                                <div class="client-panel-history-main">
                                    <p class="client-panel-history-id">Solicitud #{{ $request->id }}</p>
                                    <p class="client-panel-history-meta">
                                        Creada el {{ $request->created_at?->format('d/m/Y H:i') }}
                                    </p>
                                </div>

                                <span class="client-status-badge client-status-badge-{{ $request->status }}">
                                    @switch($request->status)
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
                                            {{ $request->status }}
                                    @endswitch
                                </span>
                            </div>

                            <div class="client-panel-history-content">
                                <p><strong>Objetivo:</strong> {{ $request->goal }}</p>

                                @if ($publishedPlan)
                                    <p><strong>Plan:</strong> {{ $publishedPlan->name }}</p>
                                    <p><strong>Versión:</strong> {{ $publishedPlan->version }}</p>
                                    <p><strong>Publicado el:</strong> {{ optional($publishedPlan->published_at)->format('d/m/Y H:i') }}</p>
                                @elseif ($request->status === 'completed')
                                    <p class="client-panel-history-empty">
                                        Esta solicitud está completada, pero no se ha encontrado un plan publicado.
                                    </p>
                                @endif

                                @if ($request->status === 'rejected' && $request->rejection_reason)
                                    <p><strong>Motivo de rechazo:</strong> {{ $request->rejection_reason }}</p>
                                @endif
                            </div>

                            <div class="client-panel-history-actions">
                                <a href="{{ route('client.request.show', ['requestId' => $request->id]) }}"
                                   class="landing-button landing-button-secondary">
                                    Ver solicitud
                                </a>

                                @if ($publishedPlan)
                                    <a href="{{ route('client.plan.show', ['requestId' => $request->id]) }}"
                                       class="landing-button landing-button-primary">
                                        Ver plan
                                    </a>
                                @endif
                            </div>
                        </article>
                    @endforeach
                </div>
            </section>
        @endif
    </section>
@endsection