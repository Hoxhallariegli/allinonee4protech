<?php

namespace App\Livewire\Admin\ClinicManagement\Visits;

use App\Models\ClinicManagement\Visit;
use Livewire\Component;

class Row extends Component { public Visit $item; public function render() { return view('livewire.admin.clinic-management.visits.row'); } }