<?php

namespace App\Livewire\Admin\ClinicManagement\MedicalVitals;

use App\Models\ClinicManagement\MedicalVital;
use Livewire\Component;

class Row extends Component { public MedicalVital $item; public function render() { return view('livewire.admin.clinic-management.medical-vitals.row'); } }