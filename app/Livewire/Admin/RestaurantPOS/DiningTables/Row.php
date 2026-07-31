<?php

namespace App\Livewire\Admin\RestaurantPOS\DiningTables;

use App\Models\RestaurantPOS\DiningTable;
use Livewire\Component;

class Row extends Component { public DiningTable $item; public function render() { return view('livewire.admin.restaurant-p-o-s.dining-tables.row'); } }