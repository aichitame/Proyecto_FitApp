<div class="auth-page auth-login-page">
    <div class="auth-card flex flex-col gap-6">
        <x-auth-header
            :title="__('Iniciar sesión')"
            :description="__('Introduce tu correo electrónico y tu contraseña para acceder')"
        />

        <!-- Session Status -->
        <x-auth-session-status class="text-center" :status="session('status')" />

        <form wire:submit="login" class="flex flex-col gap-6">
            <!-- Email Address -->
            <flux:input
                wire:model="email"
                :label="__('Correo electrónico')"
                type="email"
                required
                autofocus
                autocomplete="email"
                placeholder="correo@ejemplo.com"
            />

            <!-- Password -->
            <div class="relative">
                <flux:input
                    wire:model="password"
                    :label="__('Contraseña')"
                    type="password"
                    required
                    autocomplete="current-password"
                    :placeholder="__('Contraseña')"
                    viewable
                />

                @if (Route::has('password.request'))
                    <flux:link class="absolute end-0 top-0 text-sm" :href="route('password.request')" wire:navigate>
                        {{ __('¿Has olvidado tu contraseña?') }}
                    </flux:link>
                @endif
            </div>

            <!-- Remember Me -->
            <flux:checkbox wire:model="remember" :label="__('Recordarme')" />

            <div class="flex items-center justify-end">
                <flux:button
                    variant="primary"
                    type="submit"
                    class="w-full !bg-[#a3ebd3] !border-[#8ee3c6] !text-[#103329] hover:!bg-[#8ee3c6] hover:!border-[#74d5b3]"
                >
                    {{ __('Iniciar sesión') }}
                </flux:button>
            </div>
        </form>

        @if (Route::has('register'))
            <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-zinc-600 dark:text-zinc-400">
                {{ __('¿No tienes cuenta?') }}
                <flux:link :href="route('register')" wire:navigate>
                    {{ __('Crear cuenta') }}
                </flux:link>
            </div>
        @endif
    </div>
</div>