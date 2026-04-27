<section class="settings-page">
    <div class="settings-shell">
        <div class="settings-header">
            <p class="settings-eyebrow">Área privada de cliente</p>
            <h1 class="settings-title">Configuración</h1>
            <p class="settings-intro">Gestiona tu perfil y la configuración de tu cuenta.</p>
        </div>

        <div class="settings-card">
            <div class="settings-grid">
                <aside class="settings-sidebar">
                    <nav class="settings-nav">
                        <a
                            href="{{ route('settings.profile') }}"
                            wire:navigate
                            class="settings-nav-link {{ request()->routeIs('settings.profile') ? 'settings-nav-link-active' : '' }}"
                        > Perfil </a>

                        <a
                            href="{{ route('settings.password') }}"
                            wire:navigate
                            class="settings-nav-link {{ request()->routeIs('settings.password') ? 'settings-nav-link-active' : '' }}"
                        > Contraseña </a>

                        <a
                            href="{{ route('settings.appearance') }}"
                            wire:navigate
                            class="settings-nav-link {{ request()->routeIs('settings.appearance') ? 'settings-nav-link-active' : '' }}"
                        > Apariencia </a>
                    </nav>
                </aside>

                <div class="settings-content">
                    <div class="settings-section-header">
                        <h2 class="settings-section-title">{{ $heading ?? '' }}</h2>
                        <p class="settings-section-subtitle">{{ $subheading ?? '' }}</p>
                    </div>

                    <div class="settings-section-body">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>