<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tu plan orientativo ya está disponible</title>
</head>
<body style="margin:0; padding=0; background-color: #f8f8f8; font-family: Arial, sans-serif;color: #222222;">
    <div style="max-width: 600px; margin: 40px auto; background: #ffffff; border: 1px solid #e5e5e5; border-radius: 8px; padding: 32px;">
        <h1 style="maring-top: 0; font-size: 24px; line-height: 1.3;">
            Tu plan orientativo ya está disponible
        </h1>

        <p style="font-size: 16px; line-height: 1.6;">
            Hola {{ $clientRequest->user->name ?? 'cliente' }},
        </p>

        <p style="font-size: 16px; line-height: 1.6;">
            Ya hemos publicado una nueva versión de tu plan orientativo y ya puedes consultarlo en tu área privada.
        </p>

        <div style="margin: 24px 0; padding: 16px; background-color: #f7f7f7; border-radius: 6px;">
            <p style="margin: 0 0 8px; font-size: 14px; line-height: 1.5;">
                <strong>Plan:</strong> {{ $plan->name }}
            </p>

            <p style="margin: 0 0 8px; font-size: 14px; line-height: 1.5;">
                <strong>Versión:</strong> {{ $plan->version }}
            </p>

            <p style="margin: 0; font-size: 14px; line-height: 1.5;">
                <strong>Fecha de publicación:</strong>
                {{ optional($plan->published_at)->format('d/m/Y H:i') }}
            </p>
        </div>

        <p style="font-size: 16px; line-height: 1.6;">
            Puedes acceder a la plataforma para revisar tu plan cuando quieras.
        </p>

        <p style="font-size: 16px; line-height: 1.6; margin-bottom: 0;">
            Un saludo,<br>
            El equipo de FitApp
        </p>
    </div>
</body>
</html>