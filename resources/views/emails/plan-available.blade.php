<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plan disponible | FitApp</title>
</head>
<body style="margin:0; padding:0; background-color:#f6f7fb; font-family:Arial, Helvetica, sans-serif; color:#111827;">
    <div style="width:100%; background-color:#f6f7fb; padding:32px 16px;">
        <div style="max-width:640px; margin:0 auto; background-color:#ffffff; border:1px solid #e5e7eb; border-radius:20px; overflow:hidden; box-shadow:0 8px 24px rgba(15, 23, 42, 0.06);">
            
            <div style="background:linear-gradient(135deg, #f4b183 0%, #f7c59f 100%); padding:24px 32px;">
                <p style="margin:0; font-size:14px; font-weight:700; letter-spacing:0.08em; text-transform:uppercase; color:#7c2d12;">
                    FitApp
                </p>

                <h1 style="margin:12px 0 0 0; font-size:30px; line-height:1.25; color:#1f2937;">
                    Ya puedes consultar tu plan orientativo
                </h1>
            </div>

            <div style="padding:32px;">
                <p style="margin:0 0 16px 0; font-size:16px; line-height:1.7; color:#374151;">
                    Hola {{ $clientRequest->user?->name ?? 'cliente' }},
                </p>

                <p style="margin:0 0 20px 0; font-size:16px; line-height:1.7; color:#374151;">
                    Tu plan orientativo ya está listo y disponible en tu área privada de FitApp. Ya puedes acceder para revisarlo cuando quieras.
                </p>

                <div style="margin:24px 0; padding:20px; background-color:#fff7f2; border:1px solid #fed7aa; border-radius:14px;">
                    <p style="margin:0 0 10px 0; font-size:14px; line-height:1.6; color:#374151;">
                        <strong style="color:#111827;">Plan:</strong> {{ $plan->name }}
                    </p>

                    <p style="margin:0 0 10px 0; font-size:14px; line-height:1.6; color:#374151;">
                        <strong style="color:#111827;">Versión:</strong> {{ $plan->version }}
                    </p>

                    <p style="margin:0; font-size:14px; line-height:1.6; color:#374151;">
                        <strong style="color:#111827;">Fecha de publicación:</strong>
                        {{ optional($plan->published_at)->format('d/m/Y H:i') }}
                    </p>
                </div>

                <div style="margin:32px 0; text-align:center;">
                    <a href="{{ route('dashboard') }}"
                       style="display:inline-block; background-color:#f4b183; color:#1f2937; text-decoration:none; padding:14px 26px; border-radius:12px; font-size:15px; font-weight:700;">
                        Ver mi plan
                    </a>
                </div>

                <p style="margin:0 0 20px 0; font-size:15px; line-height:1.7; color:#4b5563;">
                    Este correo te avisa de que tu solicitud ya ha sido gestionada y tu plan se encuentra disponible para su consulta.
                </p>

                <div style="padding-top:20px; border-top:1px solid #e5e7eb;">
                    <p style="margin:0 0 12px 0; font-size:15px; line-height:1.7; color:#374151;">
                        Un saludo,<br>
                        <strong>El equipo de FitApp</strong>
                    </p>

                    <p style="margin:0; font-size:12px; line-height:1.6; color:#6b7280;">
                        Este contenido tiene carácter exclusivamente orientativo y no sustituye el asesoramiento de profesionales sanitarios.
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>