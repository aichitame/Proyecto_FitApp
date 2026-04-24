<div class="wizard-page">
    <div class="wizard-shell">
        <div class="wizard-header">
            <div>
                <p class="wizard-eyebrow">Área privada de cliente</p>
                <h1 class="wizard-title">Nueva solicitud</h1>
                <p class="wizard-intro">
                    Completa tu valoración inicial paso a paso. La información que indiques nos ayudará a preparar tu plan orientativo.
                </p>
            </div>

            <div class="wizard-progress-box">
                <span class="wizard-progress-text">Paso {{ $step }} de 4</span>
                <div class="wizard-progress-track" aria-hidden="true">
                    <div class="wizard-progress-bar wizard-progress-step-{{ $step }}"></div>
                </div>
            </div>
        </div>

        @if (session()->has('success'))
            <div class="wizard-alert wizard-alert-success">
                {{ session('success') }}
            </div>
        @endif

        @error('form')
            <div class="wizard-alert wizard-alert-error">
                {{ $message }}
            </div>
        @enderror

        <div class="wizard-card">
            @if ($step === 1)
                <section class="wizard-section">
                    <div class="wizard-section-header">
                        <h2 class="wizard-heading">Datos personales y de contexto</h2>
                        <p class="wizard-description">Completa esta primera parte con tus datos básicos.</p>
                    </div>

                    <div class="wizard-grid wizard-grid-2">
                        <div class="wizard-field">
                            <label for="age" class="wizard-label">Edad</label>
                            <input id="age" type="number" wire:model.live="form.age" class="wizard-input" min="1" placeholder="Ej. 28">
                            @error('form.age')
                                <p class="wizard-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="wizard-field">
                            <label for="gender" class="wizard-label">Sexo</label>
                            <input id="gender" type="text" wire:model.live="form.gender" class="wizard-input" placeholder="Ej. Femenino">
                            @error('form.gender')
                                <p class="wizard-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="wizard-field">
                            <label for="height" class="wizard-label">Altura (cm)</label>
                            <input id="height" type="number" wire:model.live="form.height" class="wizard-input" min="1" placeholder="Ej. 170">
                            @error('form.height')
                                <p class="wizard-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="wizard-field">
                            <label for="weight" class="wizard-label">Peso (kg)</label>
                            <input id="weight" type="number" wire:model.live="form.weight" class="wizard-input" min="1" placeholder="Ej. 65">
                            @error('form.weight')
                                <p class="wizard-error">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </section>
            @elseif ($step === 2)
                <section class="wizard-section">
                    <div class="wizard-section-header">
                        <h2 class="wizard-heading">Hábitos alimenticios</h2>
                        <p class="wizard-description">Cuéntanos cómo es tu alimentación habitual.</p>
                    </div>

                    <div class="wizard-grid">
                        <div class="wizard-field">
                            <label for="eating_habits" class="wizard-label">Descripción de hábitos alimenticios</label>
                            <textarea id="eating_habits" wire:model="form.eating_habits" class="wizard-textarea" placeholder="Describe cómo sueles comer durante la semana, horarios, preferencias, etc."></textarea>
                            @error('form.eating_habits')
                                <p class="wizard-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <label class="wizard-checkbox-card">
                            <input type="checkbox" wire:model.live="form.has_allergies">
                            <span>¿Tienes alergias o intolerancias?</span>
                        </label>

                        @if ($form['has_allergies'])
                            <div class="wizard-field">
                                <label for="allergies_description" class="wizard-label">En caso afirmativo, ¿cuáles?</label>
                                <textarea id="allergies_description" wire:model="form.allergies_description" class="wizard-textarea" placeholder="Indica alergias, intolerancias o alimentos que deban tenerse en cuenta"></textarea>
                                @error('form.allergies_description')
                                    <p class="wizard-error">{{ $message }}</p>
                                @enderror
                            </div>
                        @endif
                    </div>
                </section>
            @elseif ($step === 3)
                <section class="wizard-section">
                    <div class="wizard-section-header">
                        <h2 class="wizard-heading">Actividad física</h2>
                        <p class="wizard-description">Cuéntanos acerca de tu actividad física.</p>
                    </div>

                    <div class="wizard-grid">
                        <div class="wizard-field">
                            <label for="training_frequency" class="wizard-label">Frecuencia de actividad física</label>
                            <select id="training_frequency" wire:model="form.training_frequency" class="wizard-select">
                                <option value="">Selecciona una opción</option>
                                <option value="none">Ninguna</option>
                                <option value="1_2_days">1-2 días por semana</option>
                                <option value="3_4_days">3-4 días por semana</option>
                                <option value="5_plus_days">5 o más días por semana</option>
                            </select>
                            @error('form.training_frequency')
                                <p class="wizard-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="wizard-field">
                            <p class="wizard-label">Tipo de actividad física</p>

                            <div class="wizard-checkbox-grid">
                                <label class="wizard-checkbox-card">
                                    <input type="checkbox" value="walking" wire:model.live="form.training_type">
                                    <span>Caminar</span>
                                </label>

                                <label class="wizard-checkbox-card">
                                    <input type="checkbox" value="running" wire:model.live="form.training_type">
                                    <span>Running</span>
                                </label>

                                <label class="wizard-checkbox-card">
                                    <input type="checkbox" value="gym" wire:model.live="form.training_type">
                                    <span>Gimnasio</span>
                                </label>

                                <label class="wizard-checkbox-card">
                                    <input type="checkbox" value="cycling" wire:model.live="form.training_type">
                                    <span>Ciclismo</span>
                                </label>

                                <label class="wizard-checkbox-card">
                                    <input type="checkbox" value="yoga_pilates" wire:model.live="form.training_type">
                                    <span>Yoga / Pilates</span>
                                </label>

                                <label class="wizard-checkbox-card">
                                    <input type="checkbox" value="swimming" wire:model.live="form.training_type">
                                    <span>Natación</span>
                                </label>

                                <label class="wizard-checkbox-card">
                                    <input type="checkbox" value="team_sports" wire:model.live="form.training_type">
                                    <span>Deporte de equipo</span>
                                </label>

                                <label class="wizard-checkbox-card">
                                    <input type="checkbox" value="other" wire:model.live="form.training_type">
                                    <span>Otro</span>
                                </label>
                            </div>

                            @error('form.training_type')
                                <p class="wizard-error">{{ $message }}</p>
                            @enderror
                        </div>

                        @if (in_array('other', $form['training_type']))
                            <div class="wizard-field">
                                <label for="other_training_type" class="wizard-label">Otro tipo de actividad</label>
                                <input id="other_training_type" type="text" wire:model="form.other_training_type" class="wizard-input" placeholder="Especifica la actividad">
                                @error('form.other_training_type')
                                    <p class="wizard-error">{{ $message }}</p>
                                @enderror
                            </div>
                        @endif

                        <div class="wizard-field">
                            <label for="physical_limitations" class="wizard-label">Limitaciones físicas o lesiones</label>
                            <textarea id="physical_limitations" wire:model="form.physical_limitations" class="wizard-textarea" placeholder="Indica lesiones, molestias o limitaciones relevantes"></textarea>
                        </div>
                    </div>
                </section>
            @elseif ($step === 4)
                <section class="wizard-section">
                    <div class="wizard-section-header">
                        <h2 class="wizard-heading">Objetivo y confirmación final</h2>
                        <p class="wizard-description">Cuéntanos cuál es tu objetivo.</p>
                    </div>

                    <div class="wizard-grid">
                        <div class="wizard-field">
                            <label for="main_goal" class="wizard-label">Objetivo principal</label>
                            <textarea id="main_goal" wire:model="form.main_goal" class="wizard-textarea" placeholder="Ej. perder grasa, ganar masa muscular, mejorar hábitos..."></textarea>
                            @error('form.main_goal')
                                <p class="wizard-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="wizard-field">
                            <label for="additional_notes" class="wizard-label">Observaciones adicionales</label>
                            <textarea id="additional_notes" wire:model="form.additional_notes" class="wizard-textarea" placeholder="Añade cualquier información que consideres importante"></textarea>
                        </div>

                        <label class="wizard-checkbox-card wizard-checkbox-card-full">
                            <input type="checkbox" wire:model.live="form.accepts_informative_notice">
                            <span>He comprendido que este servicio es orientativo y no constituye asesoramiento médico.</span>
                        </label>

                        @error('form.accepts_informative_notice')
                            <p class="wizard-error">{{ $message }}</p>
                        @enderror
                    </div>
                </section>
            @endif

            <div class="wizard-actions">
                @if ($step > 1)
                    <button type="button" wire:click="previousStep" class="wizard-button wizard-button-secondary">
                        Anterior
                    </button>
                @endif

                @if ($step < 4)
                    <button type="button" wire:click="nextStep" class="wizard-button wizard-button-primary">
                        Siguiente
                    </button>
                @endif

                @if ($step === 4)
                    <button type="button" wire:click="submit" class="wizard-button wizard-button-primary">
                        Enviar solicitud
                    </button>
                @endif
            </div>
        </div>
    </div>
</div>