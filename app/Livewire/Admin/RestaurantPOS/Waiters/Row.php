<?php

namespace App\Livewire\Admin\RestaurantPOS\Waiters;

use App\Models\RestaurantPOS\Waiter;
use Livewire\Component;

class Row extends Component { public Waiter $item; public function render() { return view('livewire.admin.restaurant-p-o-s.waiters.row'); } }