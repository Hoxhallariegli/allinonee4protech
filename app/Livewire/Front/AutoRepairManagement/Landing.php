<?php

namespace App\Livewire\Front\AutoRepairManagement;

use Livewire\Component;
use Livewire\Attributes\Title;
use App\Models\AutoRepairManagement\Service;
use App\Models\AutoRepairManagement\Mechanic;

#[Title('The Auto Station')]
class Landing extends Component
{
    public function render()
    {
        return view('livewire.front.auto-repair-management.landing', [
            'services' => Service::all(),
            'mechanics' => Mechanic::with('employee')->get(),
        ])->layout('components.layouts.front');
    }
}
