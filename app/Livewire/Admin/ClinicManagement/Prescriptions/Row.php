<?php

namespace App\Livewire\Admin\ClinicManagement\Prescriptions;

use App\Models\ClinicManagement\Prescription;
use Livewire\Component;

class Row extends Component { public Prescription $item; public function render() { return view('livewire.admin.clinic-management.prescriptions.row'); } }