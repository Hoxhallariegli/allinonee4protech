<?php

namespace App\Livewire\Admin\SchoolManagement\Assignments;

use App\Models\SchoolManagement\Assignment;
use Livewire\Component;

class Row extends Component { public Assignment $item; public function render() { return view('livewire.admin.school-management.assignments.row'); } }