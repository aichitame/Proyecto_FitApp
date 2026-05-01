@extends('layouts.public')

@section('content')
    <section class="landing-info-section">
        <div class="landing-info-box">
            <div class="landing-section-header">
                <h1 class="landing-section-title">
                    Cómo funciona
                </h1>

                <p class="landing-section-text">
                    El proceso está pensado para que puedas enviar tu información de forma sencilla,
                    consultar el estado de tu solicitud y acceder a tu plan orientativo cuando esté disponible.
                </p>
            </div>

            <div class="how-steps">
                <article class="how-step-card">
                    <span>1º</span>
                    <h2>Crea tu cuenta</h2>
                    <p>
                        Regístrate para acceder a tu área privada y poder iniciar una solicitud.
                    </p>
                </article>

                <article class="how-step-card">
                    <span>2º</span>
                    <h2>Completa tu solicitud</h2>
                    <p>
                        Comparte tus datos básicos, hábitos de alimentación, actividad física y objetivo principal.
                    </p>
                </article>

                <article class="how-step-card">
                    <span>3º</span>
                    <h2>Revisión del equipo</h2>
                    <p>
                        El equipo revisa la información enviada y prepara un plan orientativo asociado a tu solicitud.
                    </p>
                </article>

                <article class="how-step-card">
                    <span>4º</span>
                    <h2>Consulta tu plan</h2>
                    <p>
                        Cuando el plan esté publicado, recibirás un aviso y podrás consultarlo desde tu área privada.
                    </p>
                </article>
            </div>
        </div>
    </section>
@endsection