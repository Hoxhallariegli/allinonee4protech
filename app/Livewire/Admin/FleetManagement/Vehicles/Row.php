<?php

namespace App\Livewire\Admin\FleetManagement\Vehicles;

use App\Models\FleetManagement\Vehicle;
use Livewire\Component;

class Row extends Component { public Vehicle $item; public function render() { return view('livewire.admin.fleet-management.vehicles.row'); } }