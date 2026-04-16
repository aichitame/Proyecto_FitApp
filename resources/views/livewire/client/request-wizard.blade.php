<div>
    <h1>Nueva solicitud</h1>

    @if(session()->has('success'))
        <p>{{ session('success') }}</p>
    @endif

    <p>Paso actual: {{ $step }} de 4</p>

    @if ($step === 1)
    <h2>Datos personales y de contexto</h2>
    <p>Completa esta primera parte con tus datos básicos.</p>
    <div>
        <label for="age">Edad</label>
        <input id="age" type="number" wire:model="form.age">
        @error('form.age')
        <p>{{ $message }}</p>
        @enderror

        <label for="gender">Sexo</label>
        <input id="gender" type="text" wire:model="form.gender">
        @error('form.gender')
        <p>{{ $message }}</p>
        @enderror

        <label for="height">Altura</label>
        <input id="height" type="number" wire:model="form.height">
        @error('form.height')
        <p>{{ $message }}</p>
        @enderror

        <label for="weight">Peso</label>
        <input id="weight" type="number" wire:model="form.weight">
        @error('form.weight')
        <p>{{ $message }}</p>
        @enderror
    </div>

    @elseif ($step === 2)
    <div>
        <h2>Hábitos alimenticios</h2>
        <p>Cuéntanos cómo es tu alimentación habitual.</p>

        <label for="eating_habits">Descripción de hábitos alimenticios</label>
        <textarea id="eating_habits" wire:model="form.eating_habits"></textarea>
        @error('form.eating_habits')
            <p>{{ $message }}</p>
        @enderror

        <label>
        <input type="checkbox" wire:model="form.has_allergies">
        ¿Tienes alergias o intolerancias?
        </label>

        <label for="allergies_description">
        En caso afirmativo, ¿cuáles?
        </label>
        <textarea id="allergies_description" wire:model="form.allergies_description"></textarea>
        @error('form.allergies_description')
            <p>{{ $message }}</p>
        @enderror
    </div>

    @elseif ($step === 3)
    <div>
        <h2>Actividad física</h2>
        <p>Cuéntanos acerca de tu actividad física.</p>

        <label for="training_frequency">Frecuencia de actividad física</label>
        <select id="training_frequency" wire:model="form.training_frequency">
            <option value="">Selecciona una opción</option>
            <option value="none">Ninguna</option>
            <option value="1_2_days">1-2 días por semana</option>
            <option value="3_4_days">3-4 días por semana</option>
            <option value="5_plus_days">5 o más días por semana</option>
        </select>
        @error('form.training_frequency')
            <p>{{ $message }}</p>
            @enderror

        <p>Tipo de actividad física</p>

        <label>
            <input type="checkbox" value="walking" wire:model="form.training_type">Caminar
        </label>

        <label>
            <input type="checkbox" value="running" wire:model="form.training_type">Running
        </label>

        <label>
            <input type="checkbox" value="gym" wire:model="form.training_type">Gimnasio
        </label>

        <label>
            <input type="checkbox" value="cycling" wire:model="form.training_type">Ciclismo
        </label>

        <label>
            <input type="checkbox" value="yoga_pilates" wire:model="form.training_type">Yoga/Pilates
        </label>

        <label>
            <input type="checkbox" value="swimming" wire:model="form.training_type">Natación
        </label>

        <label>
            <input type="checkbox" value="team_sports" wire:model="form.training_type">Deporte de equipo
        </label>

        <label>
            <input type="checkbox" value="other" wire:model="form.training_type">Otro
        </label>
        @error('form.training_type')
            <p>{{ $message }}</p>
        @enderror

        <label for="other_training_type">Otro:</label>
        <input id="other_training_type" type="text" wire:model="form.other_training_type">
        @error('form.other_training_type')
            <p>{{ $message }}</p>
        @enderror

        <label for="physical_limitations">Limitaciones físicas o lesiones</label>
        <textarea id="physical_limitations" wire:model="form.physical_limitations"></textarea>
    </div>

    @elseif ($step === 4)
    <div>
        <h2>Objetivo y confirmación final</h2>
        <p>Cuéntanos cuál es tu objetivo.</p>

        <label for="main_goal">Objetivo principal</label>
        <textarea id="main_goal" wire:model="form.main_goal"></textarea>
        @error('form.main_goal')
            <p>{{ $message }}</p>
        @enderror

        <label for="additional_notes">Observaciones adicionales</label>
        <textarea id="additional_notes" wire:model="form.additional_notes"></textarea>

        <label>
            <input type="checkbox" wire:model="form.accepts_informative_notice">
            He comprendido que este servicio es orientativo y no constituye asesoramiento médico.
        </label>
        @error('form.accepts_informative_notice')
        <p>{{ $message }}</p>
        @enderror
    </div>
    @endif

    @if($step > 1)
    <button type="button" wire:click="previousStep">
        Anterior
    </button>
    @endif

    @if($step < 4)
    <button type="button" wire:click="nextStep">
        Siguiente
    </button>
    @endif

    @if ($step === 4)
    <button type="button" wire:click="submit">
        Enviar solicitud
    </button>
    @endif
</div>