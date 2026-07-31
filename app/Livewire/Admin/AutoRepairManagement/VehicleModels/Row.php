<?php

namespace App\Livewire\Admin\AutoRepairManagement\VehicleModels;

use App\Models\AutoRepairManagement\VehicleModel;
use Livewire\Component;

class Row extends Component { public VehicleModel $item; public function render() { return view('livewire.admin.auto-repair-management.vehicle-models.row'); } }