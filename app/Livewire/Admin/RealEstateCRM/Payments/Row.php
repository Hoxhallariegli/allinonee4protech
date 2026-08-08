<?php

namespace App\Livewire\Admin\RealEstateCRM\Payments;

use App\Models\RealEstateCRM\Payment;
use Livewire\Component;

class Row extends Component { public Payment $item; public function render() { return view('livewire.admin.real-estate-c-r-m.payments.row'); } }