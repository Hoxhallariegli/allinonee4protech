<?php

namespace App\Livewire\Admin\Appointments;

use App\Models\Appointment;
use Livewire\Component;

class Row extends Component { public Appointment $item; public function render() { return view('livewire.admin.appointments.row'); } }