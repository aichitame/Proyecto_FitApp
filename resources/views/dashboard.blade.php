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
                <h2>Cómo funciona tu solicitud</h2>
                <p>Completa el formulario con tus datos, hábitos y objetivo principal. El equipo revisará la información
                y publicará tu plan orientativo cuando esté preparado.</p>

                <a href="{{ route('como-funciona') }}" class="landing-button landing-button-primary">
                    Ver cómo funciona
                </a>
            </article>
        </section>

        @if ($clientRequests->count() > 1)
    <section class="client-panel-history">
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