<?php

namespace App\Livewire\Front\RealEstateCRM;

use Livewire\Component;
use Livewire\Attributes\Title;
use App\Models\RealEstateCRM\Property;
use App\Models\RealEstateCRM\Agent;

#[Title('Elite Estates Tirana')]
class Landing extends Component
{
    public $search = '';
    public $selectedType = null;

    public function render()
    {
        $properties = Property::query()
            ->when($this->selectedType, fn($q) => $q->where('listing_type', $this->selectedType))
            ->when($this->search, fn($q) => $q->where('title', 'like', '%'.$this->search.'%'))
            ->get();

        return view('livewire.front.real-estate-c-r-m.landing', [
            'properties' => $properties,
            'agents' => Agent::all(),
        ])->layout('components.layouts.front');
    }
}
