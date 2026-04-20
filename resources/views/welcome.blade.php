@extends('layouts.public')

@section('content')
    <section class="landing-hero">
        <div class="landing-hero-content">
            <p class="landing-eyebrow">Planificación nutricional y deportiva orientativa</p>

            <h1 class="landing-title">FitApp</h1>

            <p class="landing-subtitle">
                Solicita tu valoración inicial y recibe un plan orientativo adaptado a tus hábitos, actividad física y objetivos.
            </p>

        <div class="landing-actions">
            @guest
                <a href="{{ route('register') }}" class="landing-button landing-button-primary">Crear cuenta</a>
                <a href="{{ route('login') }}" class="landing-button landing-button-secondary">Iniciar sesión</a>
            @endguest

            @auth
                <a href="{{ route('dashboard') }}" class="landing-button landing-button-primary">Ir a mi panel</a>
            @endauth
            </div>
        </div>
    </section>

        <section class="landing-features">
            <div class="landing-feature-card">
                <h2>Para clientes</h2>
                <p>
                    Comparte tu solicitud paso a paso y comparte tu contexto físico, alimenticio y tu objetivo principal.
                </p>
            </div>

        <div class="landing-feature-card">
            <h2>Seguimiento claro</h2>
            <p>
                Consulta el estado de tu solicitud y recibe avisos cuando tu plan orientativo esté disponible.
            </p>
        </div>

        <div class="landing-feature-card">
            <h2>Área profesional</h2>
            <p>
                El equipo administrador podrá revisar solicitudes y preparar planes internos de forma organizada.
            </p>
        </div>
    </section>
</main>
</body>
</html>