<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Plan disponible | FitApp</title>
</head>
<body class="plan-mail-body">
    <div class="plan-mail-wrapper">
        <h1 class="plan-mail-title">
            Ya puedes consultar tu plan orientativo
        </h1>

        <p class="plan-mail-text">
            Hola{{ $clientRequest->user?->name? '' . $clientRequest->user->name : '' }},
        </p>

        <p class="plan-mail-text">
            Tu plan orientativo ya está listo y disponible en tu área privada de FitApp.
        </p>

        <div class="plan-mail-info-box">
            <p class="plan-mail-info-item">
                <strong>Plan:</strong>{{ $plan->name }}
            </p>

            <p class="plan-mail-info-item">
                <strong>Versión:</strong>{{ $plan->version }}
            </p>

            <p class="plan-mail-info-item">
                <strong>Fecha de publicación:</strong>
            {{ optional($plan->published_at)->format('d/m/Y H:i') }}
            </p>
        </div>

        <div class="plan-mail-button-wrapper">
            <a href="{{ route('dashboard') }}" class="plan-mail-button">
                Ver mi plan
            </a>
        </div>

        <p class="plan-mail-text">
            Accede ahora para revisar los detalles cuando quieras.
        </p>

        <p class="plan-mail-text plan-mail-text-last">
            Un saludo, <br>
            El equipo de FitApp
        </p>
    </div>
</body>
</html>