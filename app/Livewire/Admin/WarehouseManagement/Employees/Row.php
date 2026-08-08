<?php

namespace App\Livewire\Admin\WarehouseManagement\Employees;

use App\Models\WarehouseManagement\Employee;
use Livewire\Component;

class Row extends Component { public Employee $item; public function render() { return view('livewire.admin.warehouse-management.employees.row'); } }