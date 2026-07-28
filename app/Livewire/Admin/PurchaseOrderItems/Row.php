<?php

namespace App\Livewire\Admin\PurchaseOrderItems;

use App\Models\PurchaseOrderItem;
use Livewire\Component;

class Row extends Component { public PurchaseOrderItem $item; public function render() { return view('livewire.admin.purchase-order-items.row'); } }