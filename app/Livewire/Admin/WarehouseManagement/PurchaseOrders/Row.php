<?php

namespace App\Livewire\Admin\WarehouseManagement\PurchaseOrders;

use App\Models\WarehouseManagement\PurchaseOrder;
use Livewire\Component;

class Row extends Component { public PurchaseOrder $item; public function render() { return view('livewire.admin.warehouse-management.purchase-orders.row'); } }