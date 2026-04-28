@extends('layouts.public')

@section('content')
    <section class="landing-info-section">
        <div class="landing-info-box">
            <h1 class="landing-section-title">Cómo funciona</h1>

            <p class="landing-section-text">
                El proceso está pensado para que puedas enviar tu información de forma sencilla,
                consultar el estado de tu solicitud y acceder a tu plan orientativo cuando esté disponible.
            </p>

            <div class="how-steps">
                <div class="how-step-card">
                    <span>1°</span>
                    <h2>Crea tu cuenta</h2>
                    <p>
                        Regístrate para acceder a tu área privada y poder iniciar una solicitud.
                    </p>
                </div>

                <div class="how-step-card">
                    <span>2°</span>
                    <h2>Completa tu solicitud</h2>
                    <p>
                        Comparte tus datos básicos, hábitos de alimentación, actividad física y objetivo principal.
                    </p>
                </div>

                <div class="how-step-card">
                    <span>3°</span>
                    <h2>Revisión del equipo</h2>
                    <p>
                        El equipo revisa la información enviada y prepara un plan orientativo asociado a tu solicitud.
                    </p>
                </div>

                <div class="how-step-card">
                    <span>4°</span>
                    <h2>Consulta tu plan</h2>
                    <p>
                        Cuando el plan esté publicado, recibirás un aviso y podrás consultarlo desde tu área privada.
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection