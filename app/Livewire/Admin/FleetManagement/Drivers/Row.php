<?php

namespace App\Livewire\Admin\FleetManagement\Drivers;

use App\Models\FleetManagement\Driver;
use Livewire\Component;

class Row extends Component { public Driver $item; public function render() { return view('livewire.admin.fleet-management.drivers.row'); } }