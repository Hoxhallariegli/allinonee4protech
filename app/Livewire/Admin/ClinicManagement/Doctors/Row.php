<?php

namespace App\Livewire\Admin\ClinicManagement\Doctors;

use App\Models\ClinicManagement\Doctor;
use Livewire\Component;

class Row extends Component { public Doctor $item; public function render() { return view('livewire.admin.clinic-management.doctors.row'); } }