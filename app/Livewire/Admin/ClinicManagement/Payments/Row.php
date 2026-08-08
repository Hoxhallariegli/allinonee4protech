<?php

namespace App\Livewire\Admin\ClinicManagement\Payments;

use App\Models\ClinicManagement\Payment;
use Livewire\Component;

class Row extends Component { public Payment $item; public function render() { return view('livewire.admin.clinic-management.payments.row'); } }