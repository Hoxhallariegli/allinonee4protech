<?php

namespace App\Livewire\Admin\FacilityManagement\Technicians;

use App\Models\FacilityManagement\Technician;
use Livewire\Component;

class Row extends Component { public Technician $item; public function render() { return view('livewire.admin.facility-management.technicians.row'); } }