@extends('layouts.public')

@php
    $genderLabels = [
        'Femenino' => 'Femenino',
        'Masculino' => 'Masculino',
        'Prefiero no decirlo' => 'Prefiero no decirlo',
    ];

    $activityFrequencyLabels = [
        'none' => 'Ninguna',
        '1_2_days' => '1-2 días por semana',
        '3_4_days' => '3-4 días por semana',
        '5_plus_days' => '5 o más días por semana',
    ];

    $activityTypeLabels = [
        'walking' => 'Caminar',
        'running' => 'Running',
        'gym' => 'Gimnasio',
        'cycling' => 'Ciclismo',
        'yoga_pilates' => 'Yoga / Pilates',
        'swimming' => 'Natación',
        'team_sports' => 'Deportes de equipo',
        'other' => 'Otro',
    ];

    $genderText = $genderLabels[$clientRequest->gender] ?? $clientRequest->gender;

    $activityFrequencyText = $activityFrequencyLabels[$clientRequest->physical_activity_frequency] ?? $clientRequest->physical_activity_frequency;

    $activityTypes = $clientRequest->physical_activity_type;

    if (! is_array($activityTypes)) {
        $activityTypes = $activityTypes ? [$activityTypes] : [];
    }

    $activityTypesText = collect($activityTypes)
        ->map(fn ($type) => $activityTypeLabels[$type] ?? $type)
        ->implode(', ');
@endphp

@section('content')
    <section class="client-panel">
        <div class="client-panel-header">
            <p class="client-panel-eyebrow">Área privada de cliente</p>

            <div class="client-panel-topbar">
                <h1 class="client-panel-title">
                    Solicitud #{{ $clientRequest->id }}
                </h1>

                <div class="client-panel-header-actions">
                    <a href="{{ route('dashboard') }}" class="landing-button landing-button-secondary">
                        Volver al panel
                    </a>
                </div>
            </div>

            <p class="client-panel-subtitle client-panel-subtitle-full">
                Aquí puedes consultar toda la información que enviaste en esta solicitud.
            </p>
        </div>

        <section class="client-panel-status-card">
            <div class="client-panel-status-header">
                <div>
                    <p class="client-panel-status-eyebrow">Estado de la solicitud</p>
                    <h2 class="client-panel-status-title">Resumen</h2>
                </div>

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
            </div>

            <div class="client-plan-meta">
                <p><strong>Fecha de envío:</strong> {{ $clientRequest->created_at?->format('d/m/Y H:i') }}</p>
                <p><strong>Último cambio de estado:</strong> {{ $clientRequest->status_changed_at?->format('d/m/Y H:i') ?? '—' }}</p>
            </div>

            @if ($clientRequest->status === 'rejected' && $clientRequest->rejection_reason)
                <div class="client-panel-status-note">
                    <strong>Motivo de rechazo:</strong> {{ $clientRequest->rejection_reason }}
                </div>
            @endif

            @if ($publishedPlan)
                <div class="client-panel-history-actions">
                    <a href="{{ route('client.plan.show', ['requestId' => $clientRequest->id]) }}"
                       class="landing-button landing-button-primary">
                        Ver plan publicado
                    </a>
                </div>
            @endif
        </section>

        <section class="client-panel-history">
            <div class="client-panel-history-header">
                <p class="client-panel-status-eyebrow">Detalle</p>
                <h2 class="client-panel-status-title">Información enviada</h2>
            </div>

            <div class="client-panel-history-list">
                <article class="client-panel-history-item">
                    <div class="client-panel-history-content">
                        <p class="client-request-block-title">Datos básicos</p>
                        <p><strong>Edad:</strong> {{ $clientRequest->age }}</p>
                        <p><strong>Sexo:</strong> {{ $genderText }}</p>
                        <p><strong>Altura:</strong> {{ rtrim(rtrim((string) $clientRequest->height, '0'), '.') }} cm</p>
                        <p><strong>Peso:</strong> {{ rtrim(rtrim((string) $clientRequest->weight, '0'), '.') }} kg</p>
                    </div>
                </article>

                <article class="client-panel-history-item">
                    <div class="client-panel-history-content">
                        <p class="client-request-block-title">Alimentación</p>
                        <p><strong>Hábitos alimenticios:</strong> {{ $clientRequest->eating_habits }}</p>
                        <p><strong>Alergias o intolerancias:</strong>
                            {{ $clientRequest->has_allergies ? 'Sí' : 'No' }}
                        </p>

                        @if ($clientRequest->has_allergies && $clientRequest->allergies_description)
                            <p><strong>Descripción de alergias:</strong> {{ $clientRequest->allergies_description }}</p>
                        @endif
                    </div>
                </article>

                <article class="client-panel-history-item">
                    <div class="client-panel-history-content">
                        <p class="client-request-block-title">Actividad física</p>
                        <p><strong>Frecuencia de actividad física:</strong>
                            {{ $activityFrequencyText }}</p>
                        <p><strong>Tipo de actividad física:</strong>
                            {{ $activityTypesText ?: '—' }}</p>

                        @if ($clientRequest->physical_limitations)
                            <p><strong>Limitaciones físicas:</strong>
                                {{ $clientRequest->physical_limitations }}</p>
                        @endif
                    </div>
                </article>

                <article class="client-panel-history-item">
                    <div class="client-panel-history-content">
                        <p class="client-request-block-title">Objetivo y observaciones</p>
                        <p><strong>Objetivo:</strong> {{ $clientRequest->goal }}</p>

                        @if ($clientRequest->additional_observations)
                            <p><strong>Observaciones adicionales:</strong> {{ $clientRequest->additional_observations }}</p>
                        @endif

                        <p><strong>Servicio orientativo aceptado:</strong>
                            {{ $clientRequest->orientative_service_acknowledged ? 'Sí' : 'No' }}
                        </p>
                    </div>
                </article>
            </div>
        </section>
    </section>
@endsection