<?php

namespace App\Livewire\Admin\AutoRepairManagement\Vehicles;

use App\Models\AutoRepairManagement\Vehicle;
use Livewire\Component;

class Row extends Component { public Vehicle $item; public function render() { return view('livewire.admin.auto-repair-management.vehicles.row'); } }