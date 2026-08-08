<?php

namespace App\Livewire\Admin\FleetManagement\Trips;

use App\Models\FleetManagement\Trip;
use Livewire\Component;

class Row extends Component { public Trip $item; public function render() { return view('livewire.admin.fleet-management.trips.row'); } }