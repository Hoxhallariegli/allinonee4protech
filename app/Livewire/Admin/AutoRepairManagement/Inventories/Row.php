<?php

namespace App\Livewire\Admin\AutoRepairManagement\Inventories;

use App\Models\AutoRepairManagement\Inventory;
use Livewire\Component;

class Row extends Component { public Inventory $item; public function render() { return view('livewire.admin.auto-repair-management.inventories.row'); } }