<?php

namespace App\Livewire\Admin\FleetManagement\FuelLogs;

use App\Models\FleetManagement\FuelLog;
use Livewire\Component;

class Row extends Component { public FuelLog $item; public function render() { return view('livewire.admin.fleet-management.fuel-logs.row'); } }