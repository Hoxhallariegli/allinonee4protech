<?php

namespace App\Livewire\Admin\AutoRepairManagement\Customers;

use App\Models\AutoRepairManagement\Customer;
use Livewire\Component;

class Row extends Component { public Customer $item; public function render() { return view('livewire.admin.auto-repair-management.customers.row'); } }