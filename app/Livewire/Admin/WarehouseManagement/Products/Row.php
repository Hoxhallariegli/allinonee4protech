<?php

namespace App\Livewire\Admin\WarehouseManagement\Products;

use App\Models\WarehouseManagement\Product;
use Livewire\Component;

class Row extends Component { public Product $item; public function render() { return view('livewire.admin.warehouse-management.products.row'); } }