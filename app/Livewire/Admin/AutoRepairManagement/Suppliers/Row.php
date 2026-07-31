<?php

namespace App\Livewire\Admin\AutoRepairManagement\Suppliers;

use App\Models\AutoRepairManagement\Supplier;
use Livewire\Component;

class Row extends Component { public Supplier $item; public function render() { return view('livewire.admin.auto-repair-management.suppliers.row'); } }