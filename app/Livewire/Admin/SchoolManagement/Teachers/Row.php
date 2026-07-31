<?php

namespace App\Livewire\Admin\SchoolManagement\Teachers;

use App\Models\SchoolManagement\Teacher;
use Livewire\Component;

class Row extends Component { public Teacher $item; public function render() { return view('livewire.admin.school-management.teachers.row'); } }