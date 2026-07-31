<?php

namespace App\Livewire\Admin\SchoolManagement\SchoolClasses;

use App\Models\SchoolManagement\SchoolClass;
use Livewire\Component;

class Row extends Component { public SchoolClass $item; public function render() { return view('livewire.admin.school-management.school-classes.row'); } }