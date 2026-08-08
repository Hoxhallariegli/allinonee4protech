<?php

namespace App\Livewire\Admin\AutoRepairManagement\Payments;

use App\Models\AutoRepairManagement\Payment;
use Livewire\Component;

class Row extends Component { public Payment $item; public function render() { return view('livewire.admin.auto-repair-management.payments.row'); } }