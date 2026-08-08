<?php

namespace App\Livewire\Admin\AutoRepairManagement\CustomerAddresses;

use App\Models\AutoRepairManagement\CustomerAddress;
use Livewire\Component;

class Row extends Component { public CustomerAddress $item; public function render() { return view('livewire.admin.auto-repair-management.customer-addresses.row'); } }