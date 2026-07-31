<?php

namespace App\Livewire\Admin\RestaurantPOS\MenuItems;

use App\Models\RestaurantPOS\MenuItem;
use Livewire\Component;

class Row extends Component { public MenuItem $item; public function render() { return view('livewire.admin.restaurant-p-o-s.menu-items.row'); } }