<?php

namespace App\Livewire\Admin\SchoolManagement\Payments;

use App\Models\SchoolManagement\Payment;
use Livewire\Component;

class Row extends Component { public Payment $item; public function render() { return view('livewire.admin.school-management.payments.row'); } }