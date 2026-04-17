<div class="max-w-3xl mx-auto px-6 py-8 space-y-6">
    <h1 class="text-3xl font-semibold text-gray-900">Nueva solicitud</h1>

    @if (session()->has('success'))
        <p>{{ session('success') }}</p>
    @endif

    @error('form')
        <p class="text-sm text-red-600">{{ $message }}</p>
    @enderror

<p class="text-sm text-gray-600">Paso {{ $step }} de 4</p>

    <div class="rounded-lg border p-6 space-y-4 bg-white">
        @if ($step === 1)
            <div class="space-y-4">
                <h2 class="text-2xl font-semibold text-gray-900">Datos personales y de contexto</h2>
                <p class="text-gray-600">Completa esta primera parte con tus datos básicos.</p>

                <div class="space-y-4">
                    <label for="age" class="block text-sm font-medium text-gray-700">Edad</label>
                    <input id="age" type="number" wire:model="form.age" class="w-full rounded-lg border border-gray-300 px-3 py-2">
                    @error('form.age')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror

                    <label for="gender" class="block text-sm font-medium text-gray-700">Sexo</label>
                    <input id="gender" type="text" wire:model="form.gender" class="w-full rounded-lg border border-gray-300 px-3 py-2">
                    @error('form.gender')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror

                    <label for="height" class="block text-sm font-medium text-gray-700">Altura</label>
                    <input id="height" type="number" wire:model="form.height" class="w-full rounded-lg border border-gray-300 px-3 py-2">
                    @error('form.height')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror

                    <label for="weight" class="block text-sm font-medium text-gray-700">Peso</label>
                    <input id="weight" type="number" wire:model="form.weight" class="w-full rounded-lg border border-gray-300 px-3 py-2">
                    @error('form.weight')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

        @elseif ($step === 2)
            <div class="space-y-4">
                <h2 class="text-2xl font-semibold text-gray-900">Hábitos alimenticios</h2>
                <p class="text-gray-600">Cuéntanos cómo es tu alimentación habitual.</p>

                <div class="space-y-4">
                    <label for="eating_habits" class="block text-sm font-medium text-gray-700">Descripción de hábitos alimenticios</label>
                    <textarea id="eating_habits" wire:model="form.eating_habits" class="w-full rounded-lg border border-gray-300 px-3 py-2"></textarea>
                    @error('form.eating_habits')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror

                    <label>
                        <input type="checkbox" wire:model="form.has_allergies">
                        ¿Tienes alergias o intolerancias?
                    </label>

                    @if ($form['has_allergies'])
                        <label for="allergies_description" class="block text-sm font-medium text-gray-700">En caso afirmativo, ¿cuáles?</label>
                        <textarea id="allergies_description" wire:model="form.allergies_description" class="w-full rounded-lg border border-gray-300 px-3 py-2"></textarea>
                        @error('form.allergies_description')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    @endif
                </div>
            </div>

        @elseif ($step === 3)
            <div class="space-y-4">
                <h2 class="text-2xl font-semibold text-gray-900">Actividad física</h2>
                <p class="text-gray-600">Cuéntanos acerca de tu actividad física.</p>

                <div class="space-y-4">
                    <label for="training_frequency" class="block text-sm font-medium text-gray-700">Frecuencia de actividad física</label>
                    <select id="training_frequency" wire:model="form.training_frequency" class="w-full rounded-lg border border-gray-300 px-3 py-2">
                        <option value="">Selecciona una opción</option>
                        <option value="none">Ninguna</option>
                        <option value="1_2_days">1-2 días por semana</option>
                        <option value="3_4_days">3-4 días por semana</option>
                        <option value="5_plus_days">5 o más días por semana</option>
                    </select>
                    @error('form.training_frequency')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror

                    <p>Tipo de actividad física</p>

                    <div class="space-y-2">
                        <label><input type="checkbox" value="walking" wire:model="form.training_type"> Caminar</label>
                        <label><input type="checkbox" value="running" wire:model="form.training_type"> Running</label>
                        <label><input type="checkbox" value="gym" wire:model="form.training_type"> Gimnasio</label>
                        <label><input type="checkbox" value="cycling" wire:model="form.training_type"> Ciclismo</label>
                        <label><input type="checkbox" value="yoga_pilates" wire:model="form.training_type"> Yoga/Pilates</label>
                        <label><input type="checkbox" value="swimming" wire:model="form.training_type"> Natación</label>
                        <label><input type="checkbox" value="team_sports" wire:model="form.training_type"> Deporte de equipo</label>
                        <label><input type="checkbox" value="other" wire:model="form.training_type"> Otro</label>
                    </div>

                    @error('form.training_type')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror

                    @if (in_array('other', $form['training_type']))
                        <label for="other_training_type" class="block text-sm font-medium text-gray-700">Otro:</label>
                        <input id="other_training_type" type="text" wire:model="form.other_training_type" class="w-full rounded-lg border border-gray-300 px-3 py-2">
                        @error('form.other_training_type')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    @endif

                    <label for="physical_limitations" class="block text-sm font-medium text-gray-700">Limitaciones físicas o lesiones</label>
                    <textarea id="physical_limitations" wire:model="form.physical_limitations" class="w-full rounded-lg border border-gray-300 px-3 py-2"></textarea>
                </div>
            </div>

        @elseif ($step === 4)
            <div class="space-y-4">
                <h2 class="text-2xl font-semibold text-gray-900">Objetivo y confirmación final</h2>
                <p class="text-gray-600">Cuéntanos cuál es tu objetivo.</p>

                <div class="space-y-4">
                    <label for="main_goal" class="block text-sm font-medium text-gray-700">Objetivo principal</label>
                    <textarea id="main_goal" wire:model="form.main_goal" class="w-full rounded-lg border border-gray-300 px-3 py-2"></textarea>
                    @error('form.main_goal')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror

                    <label for="additional_notes" class="block text-sm font-medium text-gray-700">Observaciones adicionales</label>
                    <textarea id="additional_notes" wire:model="form.additional_notes" class="w-full rounded-lg border border-gray-300 px-3 py-2"></textarea>

                    <label>
                        <input type="checkbox" wire:model="form.accepts_informative_notice">
                        He comprendido que este servicio es orientativo y no constituye asesoramiento médico.
                    </label>
                    @error('form.accepts_informative_notice')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        @endif

<div class="flex gap-3 mt-20">
    @if ($step > 1)
        <button type="button" wire:click="previousStep" class="rounded-lg px-4 py-2 text-black" style="background-color: #f4b183;">
        Anterior
        </button>
    @endif

    @if ($step < 4)
        <button type="button" wire:click="nextStep" class="rounded-lg px-4 py-2 text-black" style="background-color: #f4b183;">
        Siguiente
        </button>
    @endif

    @if ($step === 4)
        <button type="button" wire:click="submit" class="rounded-lg px-4 py-2 text-black" style="background-color: #f4b183;">
        Enviar solicitud
        </button>
    @endif
</div>
</div>
</div>