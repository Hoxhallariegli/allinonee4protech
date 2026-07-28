<?php

namespace App\Livewire\Admin\Vehicles;

use App\Models\Vehicle;
use Livewire\Component;

class Row extends Component { public Vehicle $item; public function render() { return view('livewire.admin.vehicles.row'); } }