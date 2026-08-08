<?php

namespace App\Livewire\Admin\WarehouseManagement\CustomerAddresses;

use App\Models\WarehouseManagement\CustomerAddress;
use Livewire\Component;

class Row extends Component { public CustomerAddress $item; public function render() { return view('livewire.admin.warehouse-management.customer-addresses.row'); } }