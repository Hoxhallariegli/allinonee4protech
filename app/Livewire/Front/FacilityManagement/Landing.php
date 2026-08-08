<?php

namespace App\Livewire\Front\FacilityManagement;

use Livewire\Component;
use Livewire\Attributes\Title;
use App\Models\FacilityManagement\Building;

#[Title('Smart Facility Management')]
class Landing extends Component
{
    public function render()
    {
        return view('livewire.front.facility-management.landing', [
            'managedBuildings' => Building::all(),
        ])->layout('components.layouts.front');
    }
}
