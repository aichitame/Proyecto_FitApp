<?php

namespace App\Livewire\Client;

use App\Models\ClientRequest;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class RequestWizard extends Component {

    public int $step = 1;

    public array $form = [
        'age' => '',
        'gender' => '',
        'height' => '',
        'weight' => '',

        'eating_habits' => '',
        'has_allergies' => false,
        'allergies_description' => '',

        'training_frequency' => '',
        'training_type' => [],
        'other_training_type' => '',
        'physical_limitations' => '',

        'main_goal' => '',
        'additional_notes' => '',
        'accepts_informative_notice' => false,
    ];

    public function nextStep(): void {
        if($this->step === 1){
            $this->validate($this->stepOneRules());
        }

        if($this->step === 2){
            $this->validate($this->stepTwoRules());
        }

        if($this->step === 3){
            $this->normalizeTrainingType();
            $this->validate($this->stepThreeRules());

            $this->resetValidation('form.other_training_type');

        if (in_array('other', $this->form['training_type'], true)
            && blank($this->form['other_training_type'])){
            $this->addError('form.other_training_type', 'Debes indicar cuál es la actividad física.');
            return;
            }
        }

        if ($this->step < 4){
            $this->step++;
        }
    }

    public function previousStep(): void {
        if($this->step > 1){
            $this->step--;
        }
    }

    public function mount(): void {
        $hasActiveRequest = ClientRequest::where('user_id', Auth::id())
        ->active()
        ->exists();

        if ($hasActiveRequest){
            $this->redirectRoute('client.requests.sent');
        }
    }

    public function render() {
        return view('livewire.client.request-wizard');
    }

    public function submit(): void {
        $this->validate($this->stepFourRules());

        $hasActiveRequest = ClientRequest::where('user_id', Auth::id())
        ->active()
        ->exists();

        if ($hasActiveRequest){
            $this->addError('form', 'Ya tienes una solicitud activa.');
            return;
        }

        $this->normalizeTrainingType();
    
        ClientRequest::create([
            'user_id' => Auth::id(),
            'age' => $this->form['age'],
            'gender' => $this->form['gender'],
            'height' => $this->form['height'],
            'weight' => $this->form['weight'],

            'eating_habits' => $this->form['eating_habits'],
            'has_allergies' => $this->form['has_allergies'],
            'allergies_description' => $this->form['allergies_description'],

            'physical_activity_frequency' => $this->form['training_frequency'],
            'physical_activity_type' => $this->form['training_type'],
            'physical_limitations' => $this->form['physical_limitations'],

            'goal' => $this->form['main_goal'],
            'additional_observations' => $this->form['additional_notes'],
            'orientative_service_acknowledged' => $this->form['accepts_informative_notice'],

            'status' => 'pending',
        ]);

        $this->redirectRoute('client.requests.sent');
    }

    protected function stepOneRules(): array {
        return [
            'form.age' => ['required', 'integer', 'min:1'],
            'form.gender' => ['required', Rule::in(['Femenino', 'Masculino', 'Prefiero no decirlo'])],
            'form.height' => ['required', 'numeric', 'min:1'],
            'form.weight' => ['required', 'numeric', 'min:1'],
        ];
    }

    protected function stepTwoRules(): array {
        return [
            'form.eating_habits' => ['required', 'string'],
            'form.has_allergies' => ['boolean'],
            'form.allergies_description' => [
                'nullable',
                'string',
                Rule::requiredIf(fn () => $this->form['has_allergies'] === true)
                ],
        ];
    }

    protected function stepThreeRules(): array {

    return [
        'form.training_frequency' => ['required', 'string'],
        'form.training_type' => ['required', 'array', 'min:1'],
        'form.physical_limitations' => ['nullable', 'string'],
    ];

    }

    protected function stepFourRules(): array {
        return [
            'form.main_goal' => ['required', 'string'],
            'form.additional_notes' => ['nullable', 'string'],
            'form.accepts_informative_notice' => ['accepted'],
        ];
    }

    private function normalizeTrainingType(): void {
        $this->form['training_type'] = array_values(
            array_filter($this->form['training_type'], fn ($value) => $value !== 'on')
        );
    }

    protected function messages(): array {
        return [

        'form.age.required' => 'Debes indicar tu edad.',
        'form.age.integer' => 'La edad debe ser un número entero.',
        'form.age.min' => 'La edad debe ser mayor que 0.',

        'form.gender.required' => 'Debes seleccionar una opción en el campo sexo.',
        'form.gender.in' => 'La opción seleccionada para el sexo no es válida.',
        'form.height.required' => 'Debes indicar tu altura.',
        'form.height.numeric' => 'La altura debe ser un número.',
        'form.weight.required' => 'Debes indicar tu peso.',
        'form.weight.numeric' => 'El peso debe ser un número.',

        'form.eating_habits.required' => 'Debes describir tus hábitos alimenticios.',
        'form.allergies_description.required_if' => 'Debes indicar cuáles son tus alergias o intolerancias.',

        'form.training_frequency.required' => 'Debes indicar la frecuencia de tu actividad física.',
        'form.training_type.required' => 'Debes seleccionar al menos un tipo de actividad física.',
        'form.training_type.min' => 'Debes seleccionar al menos un tipo de actividad física.',

        'form.main_goal.required' => 'Debes indicar tu objetivo principal.',
        'form.accepts_informative_notice.accepted' => 'Debes aceptar que este servicio es orientativo y no constituye un asesoramiento médico.',

        ];
    }

}