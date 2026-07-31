<?php

namespace App\Livewire\Admin\WarehouseManagement\Categories;

use App\Models\WarehouseManagement\Category;
use Livewire\Component;

class Row extends Component { public Category $item; public function render() { return view('livewire.admin.warehouse-management.categories.row'); } }