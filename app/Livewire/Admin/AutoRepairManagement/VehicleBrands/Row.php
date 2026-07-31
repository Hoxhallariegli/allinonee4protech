<?php

namespace App\Livewire\Admin\AutoRepairManagement\VehicleBrands;

use App\Models\AutoRepairManagement\VehicleBrand;
use Livewire\Component;

class Row extends Component { public VehicleBrand $item; public function render() { return view('livewire.admin.auto-repair-management.vehicle-brands.row'); } }