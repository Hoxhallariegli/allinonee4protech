<?php

namespace App\Livewire\Admin\RestaurantPOS\Payments;

use App\Models\RestaurantPOS\Payment;
use Livewire\Component;

class Row extends Component { public Payment $item; public function render() { return view('livewire.admin.restaurant-p-o-s.payments.row'); } }