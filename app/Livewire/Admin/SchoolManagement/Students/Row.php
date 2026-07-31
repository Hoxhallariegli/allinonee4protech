<?php

namespace App\Livewire\Admin\SchoolManagement\Students;

use App\Models\SchoolManagement\Student;
use Livewire\Component;

class Row extends Component { public Student $item; public function render() { return view('livewire.admin.school-management.students.row'); } }