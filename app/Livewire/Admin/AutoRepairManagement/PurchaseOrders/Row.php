<?php

namespace App\Livewire\Admin\AutoRepairManagement\PurchaseOrders;

use App\Models\AutoRepairManagement\PurchaseOrder;
use Livewire\Component;

class Row extends Component { public PurchaseOrder $item; public function render() { return view('livewire.admin.auto-repair-management.purchase-orders.row'); } }