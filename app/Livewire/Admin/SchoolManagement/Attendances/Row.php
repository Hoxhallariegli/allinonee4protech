<?php

namespace App\Livewire\Admin\SchoolManagement\Attendances;

use App\Models\SchoolManagement\Attendance;
use Livewire\Component;

class Row extends Component { public Attendance $item; public function render() { return view('livewire.admin.school-management.attendances.row'); } }