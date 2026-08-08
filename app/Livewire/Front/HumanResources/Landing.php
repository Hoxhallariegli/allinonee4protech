<?php

namespace App\Livewire\Front\HumanResources;

use Livewire\Component;
use Livewire\Attributes\Title;
use App\Models\HumanResources\Department;
use App\Models\HumanResources\Employee;

#[Title('HR Hub & Careers')]
class Landing extends Component
{
    public function render()
    {
        return view('livewire.front.human-resources.landing', [
            'departments' => Department::all(),
            'leadership' => Employee::take(4)->get(), // Featured team members
        ])->layout('components.layouts.front');
    }
}
