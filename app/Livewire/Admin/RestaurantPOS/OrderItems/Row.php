<?php

namespace App\Livewire\Admin\RestaurantPOS\OrderItems;

use App\Models\RestaurantPOS\OrderItem;
use Livewire\Component;

class Row extends Component { public OrderItem $item; public function render() { return view('livewire.admin.restaurant-p-o-s.order-items.row'); } }