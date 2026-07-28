<?php

namespace App\Livewire\Admin\PurchaseOrders;

use App\Models\PurchaseOrder;
use Livewire\Component;

class Row extends Component { public PurchaseOrder $item; public function render() { return view('livewire.admin.purchase-orders.row'); } }