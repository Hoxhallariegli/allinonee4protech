<?php

namespace App\Livewire\Admin\RestaurantPOS\Recipes;

use App\Models\RestaurantPOS\Recipe;
use Livewire\Component;

class Row extends Component { public Recipe $item; public function render() { return view('livewire.admin.restaurant-p-o-s.recipes.row'); } }