<?php

namespace App\Livewire\Client;

use Livewire\Component;

class RequestWizard extends Component {

    public int $step = 1;

    public function render() {
        return view('livewire.client.request-wizard');
    }
}