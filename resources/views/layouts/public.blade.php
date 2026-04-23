<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'FitApp' }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <header class="landing-header">
        <div class="landing-header-inner">
            <a href="{{ route('home') }}" class="landing-brand">FitApp</a>

            <nav class="landing-nav">
                <a href="{{ route('vision') }}" class="landing-nav-link">Nuestra visión</a>
                <a href="{{ route('como-funciona') }}" class="landing-nav-link">Cómo funciona</a>
                <a href="{{ route('contacto') }}" class="landing-nav-link">Contacto</a>

                @guest
                <a href="{{ route('admin.login') }}" class="landing-button landing-button-secondary">Acceso admin</a>
                <a href="{{ route('login') }}" class="landing-button landing-button-primary">Acceso cliente</a>
                @endguest

                @auth
                    <a href="{{ route('dashboard') }}" class="landing-button landing-button-primary">
                        Ir a mi panel
                    </a>
                @endauth
            </nav>
        </div>
    </header>

    <main class="landing-page">
        @yield('content')
    </main>
</body>
</html>