<?php

namespace App\Livewire\Admin\WarehouseManagement\StockTransfers;

use App\Models\WarehouseManagement\StockTransfer;
use Livewire\Component;

class Row extends Component { public StockTransfer $item; public function render() { return view('livewire.admin.warehouse-management.stock-transfers.row'); } }