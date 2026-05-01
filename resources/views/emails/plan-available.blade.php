<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plan disponible | FitApp</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>

<body style="margin:0; padding:0; background-color:#f6fbf9; font-family:'Quicksand', Arial, Helvetica, sans-serif; color:#172033;">
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="width:100%; background-color:#f6fbf9; margin:0; padding:0; font-family:'Quicksand', Arial, Helvetica, sans-serif;">
        <tr>
            <td align="center" style="padding:24px 14px;">
                <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="width:100%; max-width:560px; background-color:#ffffff; border:1px solid #d9e5dd; border-radius:20px; overflow:hidden; box-shadow:0 12px 30px rgba(23, 32, 51, 0.07);">
                    <tr>
                        <td style="padding:22px 30px 24px; background:linear-gradient(135deg, #a3ebd3 0%, #eef8fb 100%);">
                        <p style="margin:0 0 9px; font-size:11px; line-height:1; font-weight:800; letter-spacing:0.10em; text-transform:uppercase; color:#28745c; text-align:center;">
                        FitApp
                        </p>

                        <h1 style="margin:0; font-size:21px; line-height:1.2; color:#172033; font-weight:800; letter-spacing:-0.02em;">
                        Ya puedes consultar tu plan orientativo
                </h1>
                    </td>
                    </tr>

                    <tr>
                        <td style="padding:28px 30px;">
                            <p style="margin:0 0 12px; font-size:15px; line-height:1.55; color:#475467;">
                                Hola {{ $clientRequest->user?->name ?? 'cliente' }},
                            </p>

                            <p style="margin:0 0 20px; font-size:15px; line-height:1.6; color:#475467;">
                                Tu plan orientativo ya está listo y disponible en tu área privada de FitApp.
                                Puedes acceder para consultarlo cuando quieras.
                            </p>

                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="margin:20px 0 24px; background-color:#f8fcf9; border:1px solid #d9e5dd; border-radius:16px;">
                                <tr>
                                    <td style="padding:18px 20px;">
                                        <p style="margin:0 0 12px; font-size:12px; line-height:1; font-weight:800; letter-spacing:0.09em; text-transform:uppercase; color:#28745c;">
                                            Información del plan
                                        </p>

                                        <p style="margin:0 0 8px; font-size:14px; line-height:1.5; color:#475467;">
                                            <strong style="color:#172033;">Plan:</strong>
                                            {{ $plan->name }}
                                        </p>

                                        <p style="margin:0 0 8px; font-size:14px; line-height:1.5; color:#475467;">
                                            <strong style="color:#172033;">Versión:</strong>
                                            {{ $plan->version }}
                                        </p>

                                        <p style="margin:0; font-size:14px; line-height:1.5; color:#475467;">
                                            <strong style="color:#172033;">Fecha de publicación:</strong>
                                            {{ optional($plan->published_at)->format('d/m/Y H:i') }}
                                        </p>
                                    </td>
                                </tr>
                            </table>

                            <table role="presentation" cellspacing="0" cellpadding="0" align="center" style="margin:24px auto;">
                                <tr>
                                    <td align="center" bgcolor="#a3ebd3" style="border-radius:13px;">
                                        <a href="{{ route('client.plan.show', ['requestId' => $clientRequest->id]) }}"
                                           style="display:inline-block; padding:13px 24px; color:#103329; text-decoration:none; font-size:14px; line-height:1.2; font-weight:800; border-radius:13px;">
                                            Ver mi plan
                                        </a>
                                    </td>
                                </tr>
                            </table>

                            <p style="margin:0 0 20px; font-size:14px; line-height:1.6; color:#5f6b7a;">
                                Este correo te avisa de que tu solicitud ya ha sido gestionada y tu plan se encuentra disponible para su consulta.
                            </p>

                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="margin-top:20px; border-top:1px solid #d9e5dd;">
                                <tr>
                                    <td style="padding-top:18px;">
                                        <p style="margin:0 0 12px; font-size:14px; line-height:1.6; color:#475467;">
                                            Un saludo,<br>
                                            <strong style="color:#172033;">El equipo de FitApp</strong>
                                        </p>

                                        <p style="margin:0; padding:12px 14px; background-color:#172033; border-radius:13px; font-size:11px; line-height:1.55; color:#d4dbe6;">
                                            Este contenido tiene carácter exclusivamente orientativo y no sustituye el asesoramiento,
                                            diagnóstico o tratamiento proporcionado por profesionales sanitarios.
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>

                <p style="max-width:560px; margin:14px auto 0; font-size:11px; line-height:1.5; color:#7b8794; text-align:center;">
                    Has recibido este correo porque tu plan orientativo está disponible en tu área privada de FitApp.
                </p>
            </td>
        </tr>
    </table>
</body>
</html>