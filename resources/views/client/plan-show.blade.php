@vite('resources/css/dashboard.css')

@extends('layouts.public')

@section('content')
    <section class="client-panel">
        <div class="client-panel-header">
            <p class="client-panel-eyebrow">Área privada de cliente</p>

            <div class="client-panel-topbar">
                <h1 class="client-panel-title">
                    Mi plan orientativo
                </h1>

                <div class="client-panel-header-actions">
                    <a href="{{ route('dashboard') }}" class="landing-button landing-button-secondary">
                        Volver al panel
                    </a>
                </div>
            </div>

            <p class="client-panel-subtitle client-panel-subtitle-full">
                Aquí puedes consultar el contenido del último plan publicado para tu solicitud.
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
                <p><strong>Versión:</strong> {{ $plan->version }}</p>
                <p><strong>Fecha de publicación:</strong> {{ optional($plan->published_at)->format('d/m/Y H:i') }}</p>
            </div>
        </section>

        <section class="client-panel-card client-plan-content-card">
            <h2>Contenido del plan</h2>

            <div class="client-plan-content">
                {!! $plan->description !!}
            </div>
        </section>
    </section>
@endsection