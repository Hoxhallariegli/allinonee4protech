<?php

namespace App\Livewire\Admin\WarehouseManagement\Sales;

use App\Models\WarehouseManagement\Sale;
use Livewire\Component;

class Row extends Component { public Sale $item; public function render() { return view('livewire.admin.warehouse-management.sales.row'); } }