<?php

namespace App\Livewire\Admin\SchoolManagement\Subjects;

use App\Models\SchoolManagement\Subject;
use Livewire\Component;

class Row extends Component { public Subject $item; public function render() { return view('livewire.admin.school-management.subjects.row'); } }