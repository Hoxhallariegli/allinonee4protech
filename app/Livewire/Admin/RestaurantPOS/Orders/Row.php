<?php

namespace App\Livewire\Admin\RestaurantPOS\Orders;

use App\Models\RestaurantPOS\Order;
use Livewire\Component;

class Row extends Component { public Order $item; public function render() { return view('livewire.admin.restaurant-p-o-s.orders.row'); } }