<?php

namespace App\Livewire\Front\PharmacyManagement;

use Livewire\Component;
use Livewire\Attributes\Title;
use App\Models\PharmacyManagement\Medicine;

#[Title('The Vital Pharmacy')]
class Landing extends Component
{
    public function render()
    {
        return view('livewire.front.pharmacy-management.landing', [
            'medicines' => Medicine::take(8)->get(),
        ])->layout('components.layouts.front');
    }
}
