<?php

namespace App\Livewire\Admin\RestaurantPOS\Categories;

use App\Models\RestaurantPOS\Category;
use Livewire\Component;

class Row extends Component { public Category $item; public function render() { return view('livewire.admin.restaurant-p-o-s.categories.row'); } }