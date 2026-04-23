<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Plan disponible | FitApp</title>
</head>
<body style="margin:0; padding:0; background-color:#f9fafb; font-family:Arial, sans-serif; color:#111827;">
    <div style="max-width:640px; margin:40px auto; background-color:#ffffff; border:1px solid #e5e7eb; border-radius:16px; padding:32px;">
        <h1 style="margin:0 0 16px 0; font-size:28px; line-height:1.3; color:#111827;">
            Ya puedes consultar tu plan orientativo
        </h1>

        <p style="margin:0 0 16px 0; font-size:16px; line-height:1.7; color:#374151;">
            Hola{{ $clientRequest->user?->name ? ' ' . $clientRequest->user->name : '' }},
        </p>

        <p style="margin:0 0 16px 0; font-size:16px; line-height:1.7; color:#374151;">
            Tu plan orientativo ya está listo y disponible en tu área privada de FitApp.
        </p>

        <div style="margin:24px 0; padding:18px; background-color:#fff7f2; border:1px solid #fed7aa; border-radius:12px;">
            <p style="margin:0 0 8px 0; font-size:14px; line-height:1.6; color:#374151;">
                <strong>Plan:</strong> {{ $plan->name }}
            </p>

            <p style="margin:0 0 8px 0; font-size:14px; line-height:1.6; color:#374151;">
                <strong>Versión:</strong> {{ $plan->version }}
            </p>

            <p style="margin:0; font-size:14px; line-height:1.6; color:#374151;">
                <strong>Fecha de publicación:</strong>
                {{ optional($plan->published_at)->format('d/m/Y H:i') }}
            </p>
        </div>

        <div style="margin:28px 0;">
            <a href="{{ route('dashboard') }}"
               style="display:inline-block; background-color:#f4b183; color:#111827; text-decoration:none; padding:12px 20px; border-radius:10px; font-weight:600;">
                Ver mi plan
            </a>
        </div>

        <p style="margin:0 0 16px 0; font-size:16px; line-height:1.7; color:#374151;">
            Accede ahora para revisar los detalles cuando quieras.
        </p>

        <p style="margin:0; font-size:16px; line-height:1.7; color:#374151;">
            Un saludo,<br>
            El equipo de FitApp
        </p>
        <p style="margin:24px 0 0 0; font-size:13px; line-height:1.6; color:#6b7280;">
    Este contenido tiene carácter exclusivamente orientativo y no sustituye el asesoramiento de profesionales sanitarios.
</p>
    </div>
</body>
</html>