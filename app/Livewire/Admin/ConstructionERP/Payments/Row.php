<?php

namespace App\Livewire\Admin\ConstructionERP\Payments;

use App\Models\ConstructionERP\Payment;
use Livewire\Component;

class Row extends Component { public Payment $item; public function render() { return view('livewire.admin.construction-e-r-p.payments.row'); } }