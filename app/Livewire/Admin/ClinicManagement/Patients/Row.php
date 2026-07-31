<?php

namespace App\Livewire\Admin\ClinicManagement\Patients;

use App\Models\ClinicManagement\Patient;
use Livewire\Component;

class Row extends Component { public Patient $item; public function render() { return view('livewire.admin.clinic-management.patients.row'); } }