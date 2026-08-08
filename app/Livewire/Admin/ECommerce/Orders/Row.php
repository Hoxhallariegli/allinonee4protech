<?php

namespace App\Livewire\Admin\ECommerce\Orders;

use App\Models\ECommerce\Order;
use Livewire\Component;

class Row extends Component { public Order $item; public function render() { return view('livewire.admin.e--commerce.orders.row'); } }