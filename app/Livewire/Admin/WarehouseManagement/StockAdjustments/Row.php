<?php

namespace App\Livewire\Admin\WarehouseManagement\StockAdjustments;

use App\Models\WarehouseManagement\StockAdjustment;
use Livewire\Component;

class Row extends Component { public StockAdjustment $item; public function render() { return view('livewire.admin.warehouse-management.stock-adjustments.row'); } }