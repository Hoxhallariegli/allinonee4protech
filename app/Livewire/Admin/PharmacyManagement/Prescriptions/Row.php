<?php

namespace App\Livewire\Admin\PharmacyManagement\Prescriptions;

use App\Models\PharmacyManagement\Prescription;
use Livewire\Component;

class Row extends Component { public Prescription $item; public function render() { return view('livewire.admin.pharmacy-management.prescriptions.row'); } }