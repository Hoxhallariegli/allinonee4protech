<?php

namespace App\Livewire\Admin\HumanResources\Attendances;

use App\Models\HumanResources\Attendance;
use Livewire\Component;

class Row extends Component { public Attendance $item; public function render() { return view('livewire.admin.human-resources.attendances.row'); } }