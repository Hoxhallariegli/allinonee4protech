<?php

namespace App\Livewire\Admin\SchoolManagement\Grades;

use App\Models\SchoolManagement\Grade;
use Livewire\Component;

class Row extends Component { public Grade $item; public function render() { return view('livewire.admin.school-management.grades.row'); } }