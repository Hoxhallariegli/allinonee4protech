<?php

namespace App\Livewire\Admin\SchoolManagement\Guardians;

use App\Models\SchoolManagement\Guardian;
use Livewire\Component;

class Row extends Component { public Guardian $item; public function render() { return view('livewire.admin.school-management.guardians.row'); } }