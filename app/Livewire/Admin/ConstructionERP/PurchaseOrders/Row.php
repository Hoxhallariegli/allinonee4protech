<?php

namespace App\Livewire\Admin\ConstructionERP\PurchaseOrders;

use App\Models\ConstructionERP\PurchaseOrder;
use Livewire\Component;

class Row extends Component { public PurchaseOrder $item; public function render() { return view('livewire.admin.construction-e-r-p.purchase-orders.row'); } }