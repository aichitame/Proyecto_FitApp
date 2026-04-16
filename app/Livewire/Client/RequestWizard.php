<?php

namespace App\Livewire\Client;

use App\Models\ClientRequest;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

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
            $this->validate($this->stepThreeRules());

            $this->resetValidation('form.other_training_type');

        if (in_array('other', $this->form['training_type'], true) && blank($this->form['other_training_type'])){
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

    public function render() {
        return view('livewire.client.request-wizard');
    }

    public function submit(): void {
        $this->validate($this->stepFourRules());
        
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
            'physical_activity_type' => json_encode($this->form['training_type']),
            'physical_limitations' => $this->form['physical_limitations'],

            'goal' => $this->form['main_goal'],
            'additional_observations' => $this->form['additional_notes'],
            'orientative_service_acknowledged' => $this->form['accepts_informative_notice'],

            'status' => 'pending',
        ]);

        session()->flash('success', 'Solicitud enviada correctamente.');
        $this->redirectRoute('client.requests.create');
    }

    protected function stepOneRules(): array {
        return [
            'form.age' => ['required', 'integer', 'min:1'],
            'form.gender' => ['required', 'string'],
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
                \Illuminate\Validation\Rule::requiredIf(fn () => $this->form['has_allergies'] === true)
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
}