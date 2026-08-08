<?php

namespace App\Livewire\Front\AgricultureManagement;

use Livewire\Component;
use Livewire\Attributes\Title;
use App\Models\AgricultureManagement\Crop;

#[Title('The Harvest Station')]
class Landing extends Component
{
    public function render()
    {
        return view('livewire.front.agriculture-management.landing', [
            'crops' => Crop::take(8)->get(),
        ])->layout('components.layouts.front');
    }
}
