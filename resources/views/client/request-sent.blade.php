<x-layouts.app title="'Solicitud enviada'">
<div class="request-sent-container">
    <div class="request-sent-card">
    <h1 class="request-sent-title">¡Solicitud enviada!</h1>

    <p class="request-sent-text">
        Tu solicitud se ha registrado correctamente y está pendiente de revisión.
    </p>

    <p class="request-sent-text">
        Recibirás una notificación cuando tu plan orientativo esté disponible.
    </p>

    <a href="{{ route('dashboard') }}" class="request-sent-link">
        Volver al área privada
    </a>
</div>
</div>
</x-layouts.app>