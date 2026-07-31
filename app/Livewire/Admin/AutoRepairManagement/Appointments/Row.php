<?php

namespace App\Livewire\Admin\AutoRepairManagement\Appointments;

use App\Models\AutoRepairManagement\Appointment;
use Livewire\Component;

class Row extends Component { public Appointment $item; public function render() { return view('livewire.admin.auto-repair-management.appointments.row'); } }