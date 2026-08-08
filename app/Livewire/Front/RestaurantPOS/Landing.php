<?php

namespace App\Livewire\Front\RestaurantPOS;

use Livewire\Component;
use Livewire\Attributes\Title;
use App\Models\RestaurantPOS\MenuItem;
use App\Models\RestaurantPOS\Category;

#[Title('The Gourmet Station')]
class Landing extends Component
{
    public $selectedCategoryId = null;

    public function render()
    {
        $menuItems = MenuItem::query()
            ->with('category')
            ->when($this->selectedCategoryId, fn($q) => $q->where('category_id', $this->selectedCategoryId))
            ->get();

        return view('livewire.front.restaurant-p-o-s.landing', [
            'categories' => Category::all(),
            'menuItems' => $menuItems,
        ])->layout('components.layouts.front');
    }
}
