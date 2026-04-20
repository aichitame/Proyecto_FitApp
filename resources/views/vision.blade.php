<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuestra visión | FitApp</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <header class="landing-header">
        <div class="landing-header-inner">
            <a href="{{ route ('home') }}" class="landing-brand">FitApp</a>

            <nav class="landing-nav">
            <a href="{{ route('vision') }}" class="landing-nav-link">Nuestra visión</a>
            <a href="{{ route('como-funciona') }}" class="landing-nav-link">Cómo funciona</a>
            <a href="{{ route('contacto') }}" class="landing-nav-link">Contacto</a>
            <a href="{{ route('login') }}" class="landing-nav-link">Acceso cliente</a>
            <a href="{{ route('login') }}" class="landing-nav-button landing-button-primary">Acceso admin</a>
            </nav>
        </div>
    </header>

    <main class="landing-page">
        <section class="landing-info-section">
            <div class="landing-info-box">
                <h1 class="landing-section-title">Nuestra visión</h1>
                <p class="landing-section-text">
                    En FitApp creemos en una orientación personalizada, clara y realista, adaptada al contexto,
                    hábitos y objetivos de cada persona.
                </p>
            </div>
        </section>
    </main>
</body>
</html>