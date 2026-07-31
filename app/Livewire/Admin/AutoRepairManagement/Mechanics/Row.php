<?php

namespace App\Livewire\Admin\AutoRepairManagement\Mechanics;

use App\Models\AutoRepairManagement\Mechanic;
use Livewire\Component;

class Row extends Component { public Mechanic $item; public function render() { return view('livewire.admin.auto-repair-management.mechanics.row'); } }