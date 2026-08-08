<?php

namespace App\Livewire\Front\ECommerce;

use Livewire\Component;
use Livewire\Attributes\Title;
use App\Models\ECommerce\Product;

#[Title('The Digital Station Shop')]
class Landing extends Component
{
    public function render()
    {
        return view('livewire.front.e--commerce.landing', [
            'products' => Product::with('category')->get(),
        ])->layout('components.layouts.front');
    }
}
