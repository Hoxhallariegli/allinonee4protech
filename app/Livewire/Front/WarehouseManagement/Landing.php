<?php

namespace App\Livewire\Front\WarehouseManagement;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('WarehouseManagement')]
class Landing extends Component
{
    public function render()
    {
        return view('livewire.front.warehouse-management.landing', [
            'categories' => \App\Models\WarehouseManagement\Category::all(),
            'products' => \App\Models\WarehouseManagement\Product::with('category')->get(),
            'warehouses' => \App\Models\WarehouseManagement\Warehouse::all(),
        ])->layout('components.layouts.front');
    }
}
