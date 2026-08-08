<?php

namespace App\Livewire\Admin\SchoolManagement\Timetables;

use App\Models\SchoolManagement\Timetable;
use Livewire\Component;

class Row extends Component { public Timetable $item; public function render() { return view('livewire.admin.school-management.timetables.row'); } }