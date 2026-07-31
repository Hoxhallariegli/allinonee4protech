<?php

namespace App\Livewire\Admin\WarehouseManagement\Warehouses;

use App\Models\WarehouseManagement\Warehouse;
use Livewire\Component;

class Row extends Component { public Warehouse $item; public function render() { return view('livewire.admin.warehouse-management.warehouses.row'); } }