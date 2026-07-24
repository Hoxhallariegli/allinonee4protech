<?php

namespace App\Livewire\Admin\Products;

use App\Models\Product;
use Livewire\Component;

class Row extends Component { public Product $item; public function render() { return view('livewire.admin.products.row'); } }