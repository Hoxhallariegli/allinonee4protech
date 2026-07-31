<?php

namespace App\Livewire\Admin\WarehouseManagement\Suppliers;

use App\Models\WarehouseManagement\Supplier;
use Livewire\Component;

class Row extends Component { public Supplier $item; public function render() { return view('livewire.admin.warehouse-management.suppliers.row'); } }