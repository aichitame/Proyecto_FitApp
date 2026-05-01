<!DOCTYPE html>
<html lang="es">
<head>
    @include('partials.head')
    <title>{{ $title ?? 'FitApp' }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">

    @vite([
        'resources/css/app.css',
        'resources/css/dashboard.css',
        'resources/css/request-wizard.css',
        'resources/js/app.js',
    ])
</head>

<body>
    <header class="landing-header">
        <div class="landing-header-inner">
            <a href="{{ route('home') }}" class="landing-brand">FitApp</a>

            @if (trim($__env->yieldContent('header_actions')))
                @yield('header_actions')
            @elseif (auth()->check())
                <div class="client-header-actions">
                    <a href="{{ route('dashboard') }}" class="landing-button landing-button-secondary client-header-link">
                        Volver al panel
                    </a>

                    <form method="POST" action="{{ route('logout') }}" class="client-header-logout-form">
                        @csrf

                        <button type="submit" class="landing-button landing-button-secondary client-header-link">
                            Cerrar sesión
                        </button>
                    </form>
                </div>
            @else
                <nav class="landing-nav">
                    <a href="{{ route('vision') }}" class="landing-nav-link">Nuestra visión</a>
                    <a href="{{ route('como-funciona') }}" class="landing-nav-link">Cómo funciona</a>
                    <a href="{{ route('contacto') }}" class="landing-nav-link">Contacto</a>

                    <a href="{{ route('admin.login') }}" class="landing-button landing-button-secondary">
                        Acceso admin
                    </a>

                    <a href="{{ route('login') }}" class="landing-button landing-button-primary">
                        Acceso cliente
                    </a>
                </nav>
            @endif
        </div>
    </header>

    <main class="landing-page">
        @yield('content')
    </main>

    <footer class="landing-footer">
        <div class="landing-footer-inner">
            <p class="landing-footer-text">
                Planificación nutricional y deportiva orientativa. No constituye una herramienta médica ni sustituye el asesoramiento, diagnóstico o tratamiento de profesionales sanitarios.
            </p>

            <div class="landing-footer-legal-links">
                <a href="#">Aviso legal</a>
                <a href="#">Política de privacidad</a>
                <a href="#">Términos y condiciones</a>
            </div>
        </div>
    </footer>

    @fluxScripts
</body>
</html>