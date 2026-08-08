<?php

namespace App\Livewire\Admin\ClinicManagement\PatientAddresses;

use App\Models\ClinicManagement\PatientAddress;
use Livewire\Component;

class Row extends Component { public PatientAddress $item; public function render() { return view('livewire.admin.clinic-management.patient-addresses.row'); } }