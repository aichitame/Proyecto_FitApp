@extends('layouts.public')

@php
    $registerUrl = \Illuminate\Support\Facades\Route::has('register') ? route('register') : url('/register');
    $loginUrl = \Illuminate\Support\Facades\Route::has('login') ? route('login') : url('/login');
    $dashboardUrl = \Illuminate\Support\Facades\Route::has('dashboard') ? route('dashboard') : url('/dashboard');
@endphp

@section('content')
    <section class="landing-hero">
        <div class="landing-hero-content">
            <p class="landing-eyebrow">
                <span class="landing-eyebrow-desktop">
                    Planificación nutricional y deportiva orientativa
                </span>

                <span class="landing-eyebrow-mobile">
                    Nutrición y deporte
                </span>
            </p>

            <h1 class="landing-title">FitApp</h1>

            <p class="landing-subtitle">
                Solicita tu valoración inicial y recibe un plan orientativo adaptado a tus hábitos,
                actividad física y objetivos.
            </p>

            @auth
                <div class="landing-actions landing-auth-hero-actions">
                    <a href="{{ $dashboardUrl }}" class="landing-button landing-button-primary">Ir a mi panel</a>
                </div>
            @endauth
        </div>
    </section>

    <section class="landing-features">
        <div class="landing-feature-card">
            <span class="landing-feature-number">01</span>

            <h2>Para clientes</h2>

            <p>
                Comparte tu solicitud paso a paso y aporta tu contexto físico, alimenticio
                y tu objetivo principal desde tu área privada.
            </p>
        </div>

        <div class="landing-feature-card">
            <span class="landing-feature-number">02</span>

            <h2>Seguimiento claro</h2>

            <p>
                Consulta el estado de tu solicitud y recibe avisos cuando tu plan orientativo
                esté disponible.
            </p>
        </div>

        <div class="landing-feature-card">
            <span class="landing-feature-number">03</span>

            <h2>Área profesional</h2>

            <p>
                El equipo administrador podrá revisar solicitudes y preparar planes internos
                de forma organizada.
            </p>
        </div>
    </section>

    <section id="contacto" class="landing-info-section">
        <div class="landing-cta-box">
            <p class="landing-section-kicker">Empieza ahora</p>

            <h2 class="landing-cta-title">
                Crea tu cuenta y envía tu primera solicitud.
            </h2>

            <p class="landing-cta-text">
                Accede al área cliente, completa la información necesaria y consulta el estado
                de tu solicitud cuando quieras.
            </p>

            <div class="landing-actions landing-cta-actions">
                @guest
                    <a href="{{ $registerUrl }}" class="landing-button landing-button-primary">
                        Crear cuenta
                    </a>

                    <a href="{{ $loginUrl }}" class="landing-button landing-button-secondary">
                        Acceso cliente
                    </a>
                @else
                    <a href="{{ $dashboardUrl }}" class="landing-button landing-button-primary">
                        Ir a mi panel
                    </a>
                @endguest
            </div>
        </div>
    </section>

    <section id="funciona" class="landing-info-section">
        <div class="landing-info-box">
            <div class="landing-section-header">
                <p class="landing-section-kicker">Cómo funciona</p>

                <h2 class="landing-section-title">
                    De la solicitud inicial al plan orientativo publicado.
                </h2>

                <p class="landing-section-text">
                    FitApp organiza el proceso para que el cliente pueda enviar su información,
                    consultar el estado de la solicitud y acceder al plan cuando esté disponible.
                </p>
            </div>

            <div class="how-steps">
                <article class="how-step-card">
                    <span>01</span>
                    <h3>Registro</h3>
                    <p>
                        El cliente crea su cuenta y accede a su área privada.
                    </p>
                </article>

                <article class="how-step-card">
                    <span>02</span>
                    <h3>Solicitud</h3>
                    <p>
                        Completa sus datos, hábitos, actividad física y objetivo principal.
                    </p>
                </article>

                <article class="how-step-card">
                    <span>03</span>
                    <h3>Revisión</h3>
                    <p>
                        El administrador revisa la información y prepara el plan orientativo.
                    </p>
                </article>

                <article class="how-step-card">
                    <span>04</span>
                    <h3>Consulta</h3>
                    <p>
                        Cuando el plan está publicado, el cliente puede consultarlo desde su panel.
                    </p>
                </article>
            </div>
        </div>
    </section>

    <section id="vision" class="landing-info-section">
        <div class="landing-info-box">
            <div class="landing-section-header">
                <p class="landing-section-kicker">Nuestra visión</p>

                <h2 class="landing-section-title">
                    Una experiencia sencilla para gestionar solicitudes orientativas.
                </h2>

                <p class="landing-section-text">
                    El objetivo de FitApp es separar claramente el espacio del cliente y el área
                    profesional, manteniendo un proceso ordenado, privado y fácil de seguir.
                </p>
            </div>

            <div class="vision-principles">
                <article class="vision-principle-card">
                    <span>Claridad</span>
                    <h3>Estados visibles</h3>
                    <p>
                        Cada solicitud muestra si está pendiente, en revisión, completada o rechazada.
                    </p>
                </article>

                <article class="vision-principle-card">
                    <span>Privacidad</span>
                    <h3>Área privada</h3>
                    <p>
                        Cada cliente accede únicamente a sus propias solicitudes y planes.
                    </p>
                </article>

                <article class="vision-principle-card">
                    <span>Organización</span>
                    <h3>Gestión interna</h3>
                    <p>
                        El panel profesional centraliza la revisión y elaboración de los planes.
                    </p>
                </article>
            </div>
        </div>
    </section>

    <section class="landing-info-section">
        <div class="landing-notice-box">
            <div class="landing-notice-content">
                <div class="landing-notice-header">
                    <div class="landing-notice-mark">
                        !
                    </div>

                    <p class="landing-section-kicker">
                        Aviso importante
                    </p>
                </div>

                <h2 class="landing-notice-title">
                    Servicio informativo y orientativo
                </h2>

                <p class="landing-notice-text">
                    FitApp no constituye una herramienta médica ni sustituye el asesoramiento,
                    diagnóstico o tratamiento proporcionado por profesionales sanitarios.
                </p>
            </div>
        </div>
    </section>
@endsection