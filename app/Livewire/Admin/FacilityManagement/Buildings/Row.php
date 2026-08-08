<?php

namespace App\Livewire\Admin\FacilityManagement\Buildings;

use App\Models\FacilityManagement\Building;
use Livewire\Component;

class Row extends Component { public Building $item; public function render() { return view('livewire.admin.facility-management.buildings.row'); } }