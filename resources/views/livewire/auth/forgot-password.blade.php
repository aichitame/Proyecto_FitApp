<div class="flex flex-col gap-6">
    <x-auth-header
        :title="__('¿Has olvidado tu contraseña?')"
        :description="__('Introduce tu correo electrónico y te enviaremos un enlace para restablecerla')"
    />

    <x-auth-session-status class="text-center" :status="session('status')" />

    <form wire:submit="sendPasswordResetLink" class="flex flex-col gap-6">
        <flux:input
            wire:model="email"
            :label="__('Correo electrónico')"
            type="email"
            required
            autofocus
            autocomplete="email"
            placeholder="correo@ejemplo.com"
        />

        <flux:button type="submit" variant="primary" class="w-full">
            {{ __('Enviar enlace de recuperación') }}
        </flux:button>
    </form>

    <div class="text-center text-sm text-zinc-600">
        <flux:link :href="route('login')" wire:navigate>
            {{ __('Volver a iniciar sesión') }}
        </flux:link>
    </div>
</div>