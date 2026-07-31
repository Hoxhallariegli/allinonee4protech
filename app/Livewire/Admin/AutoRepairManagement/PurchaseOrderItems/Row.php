<?php

namespace App\Livewire\Admin\AutoRepairManagement\PurchaseOrderItems;

use App\Models\AutoRepairManagement\PurchaseOrderItem;
use Livewire\Component;

class Row extends Component { public PurchaseOrderItem $item; public function render() { return view('livewire.admin.auto-repair-management.purchase-order-items.row'); } }