<div class="wizard-container">
    <h1 class="wizard-title">Nueva solicitud</h1>

    @if (session()->has('success'))
        <p>{{ session('success') }}</p>
    @endif

    @error('form')
        <p class="wizard-error">{{ $message }}</p>
    @enderror

<p class="wizard-step">Paso {{ $step }} de 4</p>
    <div class="wizard-card">
        @if ($step === 1)
            <div class="wizard-section">
                <h2 class="wizard-heading">Datos personales y de contexto</h2>
                <p class="wizard-description">Completa esta primera parte con tus datos básicos.</p>

                <div class="wizard-section">
                    <div class="wizard-field">
                    <label for="age" class="wizard-label">Edad</label>
                    <input id="age" type="number" wire:model="form.age" class="wizard-input">
                    @error('form.age')
                        <p class="wizard-error">{{ $message }}</p>
                    @enderror
                    </div>

                    <div class="wizard-field">
                    <label for="gender" class="wizard-label">Sexo</label>
                    <input id="gender" type="text" wire:model="form.gender" class="wizard-input">
                    @error('form.gender')
                        <p class="wizard-error">{{ $message }}</p>
                    @enderror
                    </div>

                    <div class="wizard-field">
                    <label for="height" class="wizard-label">Altura</label>
                    <input id="height" type="number" wire:model="form.height" class="wizard-input">
                    @error('form.height')
                        <p class="wizard-error">{{ $message }}</p>
                    @enderror
                    </div>

                    <div class="wizard-field">
                    <label for="weight" class="wizard-label">Peso</label>
                    <input id="weight" type="number" wire:model="form.weight" class="wizard-input">
                    @error('form.weight')
                        <p class="wizard-error">{{ $message }}</p>
                    @enderror
                    </div>
                </div>
            </div>
            

        @elseif ($step === 2)
            <div class="wizard-section">
                <h2 class="wizard-heading">Hábitos alimenticios</h2>
                <p class="wizard-description">Cuéntanos cómo es tu alimentación habitual.</p>

                <div class="wizard-section">
                    <div class="wizard-field">
                    <label for="eating_habits" class="wizard-label">Descripción de hábitos alimenticios</label>
                    <textarea id="eating_habits" wire:model="form.eating_habits" class="wizard-textarea"></textarea>
                    @error('form.eating_habits')
                        <p class="wizard-error">{{ $message }}</p>
                    @enderror
                    </div>

                    <label class="wizard-checkbox">
                        <input type="checkbox" wire:model.live="form.has_allergies">
                        <span>¿Tienes alergias o intolerancias?</span>
                    </label>

                    @if ($form['has_allergies'])
                    <div class="wizard-field">
                        <label for="allergies_description" class="wizard-label">En caso afirmativo, ¿cuáles?</label>
                        <textarea id="allergies_description" wire:model="form.allergies_description" class="wizard-textarea"></textarea>
                        @error('form.allergies_description')
                            <p class="wizard-error">{{ $message }}</p>
                        @enderror
                        </div>
                    @endif
                </div>
            </div>

        @elseif ($step === 3)
            <div class="wizard-section">
                <h2 class="wizard-heading">Actividad física</h2>
                <p class="wizard-description">Cuéntanos acerca de tu actividad física.</p>

                <div class="wizard-section">
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
                        <label class="wizard-checkbox">
                            <input type="checkbox" value="walking" wire:model.live="form.training_type">
                            <span>Caminar</span>
                        </label>

                        <label class="wizard-checkbox">
                            <input type="checkbox" value="running" wire:model.live="form.training_type">
                            <span>Running</span>
                        </label>

                        <label class="wizard-checkbox">
                            <input type="checkbox" value="gym" wire:model.live="form.training_type">
                            <span>Gimnasio</span>
                        </label>

                        <label class="wizard-checkbox">
                            <input type="checkbox" value="cycling" wire:model.live="form.training_type">
                            <span>Ciclismo</span>
                        </label>

                        <label class="wizard-checkbox">
                            <input type="checkbox" value="yoga_pilates" wire:model.live="form.training_type">
                            <span>Yoga/Pilates</span>
                        </label>
                        <label class="wizard-checkbox">
                            <input type="checkbox" value="swimming" wire:model.live="form.training_type">
                            <span>Natación</span>
                        </label>

                        <label class="wizard-checkbox">
                            <input type="checkbox" value="team_sports" wire:model.live="form.training_type">
                            <span>Deporte de equipo</span>
                        </label>

                        <label class="wizard-checkbox">
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
                            <label for="other_training_type" class="wizard-label">Otro:</label>
                            <input id="other_training_type" type="text" wire:model="form.other_training_type" class="wizard-input">
                            @error('form.other_training_type')
                                <p class="wizard-error">{{ $message }}</p>
                        @enderror
                    </div>
                @endif
                    
                    <div class="wizard-field">
                    <label for="physical_limitations" class="wizard-label">Limitaciones físicas o lesiones</label>
                    <textarea id="physical_limitations" wire:model="form.physical_limitations" class="wizard-textarea"></textarea>
                    </div>
                </div>
            </div>

        @elseif ($step === 4)
            <div class="wizard-section">
                <h2 class="wizard-heading">Objetivo y confirmación final</h2>
                <p class="wizard-description">Cuéntanos cuál es tu objetivo.</p>

                <div class="wizard-section">
                    <div class="wizard-field">
                    <label for="main_goal" class="wizard-label">Objetivo principal</label>
                    <textarea id="main_goal" wire:model="form.main_goal" class="wizard-textarea"></textarea>
                    @error('form.main_goal')
                        <p class="wizard-error">{{ $message }}</p>
                    @enderror
                    </div>

                    <div class="wizard-field">
                    <label for="additional_notes" class="wizard-label">Observaciones adicionales</label>
                    <textarea id="additional_notes" wire:model="form.additional_notes" class="wizard-textarea"></textarea>
                    </div>

                    <label class="wizard-checkbox-top">
                        <input type="checkbox" wire:model.live="form.accepts_informative_notice">
                        <span>He comprendido que este servicio es orientativo y no constituye asesoramiento médico.</span>
                    </label>
                    @error('form.accepts_informative_notice')
                        <p class="wizard-error">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        @endif

<div class="wizard-actions">
    @if ($step > 1)
        <button type="button" wire:click="previousStep" class="wizard-button">
        Anterior
        </button>
    @endif

    @if ($step < 4)
        <button type="button" wire:click="nextStep" class="wizard-button">
        Siguiente
        </button>
    @endif

    @if ($step === 4)
        <button type="button" wire:click="submit" class="wizard-button">
        Enviar solicitud
        </button>
    @endif
</div>
</div>
</div>