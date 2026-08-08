<?php

namespace App\Livewire\Front\SchoolManagement;

use Livewire\Component;
use Livewire\Attributes\Title;
use App\Models\SchoolManagement\SchoolClass;
use App\Models\SchoolManagement\Teacher;

use App\Models\SchoolManagement\Subject;

#[Title('The Knowledge Academy')]
class Landing extends Component
{
    public function render()
    {
        return view('livewire.front.school-management.landing', [
            'classes' => SchoolClass::all(),
            'teachers' => Teacher::all(),
            'subjects' => Subject::all(),
        ])->layout('components.layouts.front');
    }
}
