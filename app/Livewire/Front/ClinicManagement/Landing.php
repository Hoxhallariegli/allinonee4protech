<?php

namespace App\Livewire\Front\ClinicManagement;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('ClinicManagement')]
class Landing extends Component
{
    public function render()
    {
        return view('livewire.front.clinic-management.landing', [
            'doctors' => \App\Models\ClinicManagement\Doctor::all(),
        ])->layout('components.layouts.front');
    }
}
