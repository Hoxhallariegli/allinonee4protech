<?php

namespace App\Livewire\Admin\RestaurantPOS\Ingredients;

use App\Models\RestaurantPOS\Ingredient;
use Livewire\Component;

class Row extends Component { public Ingredient $item; public function render() { return view('livewire.admin.restaurant-p-o-s.ingredients.row'); } }