@extends('layouts.public')

@section('content')
    <section class="client-panel">
        <div class="client-panel-header">
            <p class="client-panel-eyebrow">Área privada de cliente</p>

            <div class="client-panel-topbar">
                <div>
                    <h1 class="client-panel-title">
                        Mi plan orientativo
                    </h1>

                    <a href="{{ route('dashboard') }}" class="client-panel-back-link">
                        <span class="client-panel-back-link-icon" aria-hidden="true">←</span>
                        <span>Ir a mi panel</span>
                    </a>
                </div>
            </div>

            <p class="client-panel-subtitle client-panel-subtitle-full client-plan-subtitle">
                Aquí puedes consultar el último plan publicado asociado a tu solicitud #{{ $clientRequest->id }}.
            </p>
        </div>

        <section class="client-panel-status-card">
            <div class="client-panel-status-header">
                <div>
                    <p class="client-panel-status-eyebrow">Información del plan</p>
                    <h2 class="client-panel-status-title">{{ $plan->name }}</h2>
                </div>

                <span class="client-status-badge client-status-badge-completed">
                    Publicado
                </span>
            </div>

            <div class="client-plan-meta">
                <p><strong>Solicitud:</strong> #{{ $clientRequest->id }}</p>
                <p><strong>Versión:</strong> {{ $plan->version }}</p>
                <p><strong>Fecha de publicación:</strong> {{ optional($plan->published_at)->format('d/m/Y H:i') }}</p>
            </div>

            <div class="client-plan-summary">
                <p><strong>Objetivo asociado:</strong> {{ $clientRequest->goal }}</p>
            </div>

            <div class="client-plan-card-actions">
                <a href="{{ route('client.request.show', ['requestId' => $clientRequest->id]) }}"
            class="landing-button landing-button-secondary">
                Ver solicitud asociada
                </a>
            </div>
        </section>

        <section class="client-panel-card client-plan-content-card">
            <h2>Contenido del plan</h2>

            <div class="client-plan-content">
                {!! $plan->description !!}
            </div>
        </section>

        <section class="client-panel-status-card client-plan-note-card">
            <div class="client-panel-history-content">
                <p class="client-request-block-title">Importante</p>
                <p>
                    Este plan tiene carácter orientativo y se basa en la información facilitada en tu solicitud.
                    No sustituye la valoración individualizada de profesionales sanitarios.
                </p>
            </div>
        </section>
    </section>
@endsection