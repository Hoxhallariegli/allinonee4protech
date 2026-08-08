<?php

namespace App\Livewire\Admin\ECommerce\Products;

use App\Models\ECommerce\Product;
use Livewire\Component;

class Row extends Component { public Product $item; public function render() { return view('livewire.admin.e--commerce.products.row'); } }