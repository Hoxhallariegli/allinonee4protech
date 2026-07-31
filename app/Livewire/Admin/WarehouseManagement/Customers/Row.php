<?php

namespace App\Livewire\Admin\WarehouseManagement\Customers;

use App\Models\WarehouseManagement\Customer;
use Livewire\Component;

class Row extends Component { public Customer $item; public function render() { return view('livewire.admin.warehouse-management.customers.row'); } }