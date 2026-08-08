<?php

namespace App\Livewire\Front\ConstructionERP;

use Livewire\Component;
use Livewire\Attributes\Title;
use App\Models\ConstructionERP\Project;

#[Title('Build Station')]
class Landing extends Component
{
    public function render()
    {
        return view('livewire.front.construction-e-r-p.landing', [
            'projects' => Project::all(),
        ])->layout('components.layouts.front');
    }
}
