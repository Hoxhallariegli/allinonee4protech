<?php

namespace App\Livewire\Admin\AgricultureManagement\InventorySupplies;

use App\Models\AgricultureManagement\InventorySupply;
use Livewire\Component;

class Row extends Component { public InventorySupply $item; public function render() { return view('livewire.admin.agriculture-management.inventory-supplies.row'); } }