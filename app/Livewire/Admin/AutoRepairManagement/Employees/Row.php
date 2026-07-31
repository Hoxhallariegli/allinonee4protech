<?php

namespace App\Livewire\Admin\AutoRepairManagement\Employees;

use App\Models\AutoRepairManagement\Employee;
use Livewire\Component;

class Row extends Component { public Employee $item; public function render() { return view('livewire.admin.auto-repair-management.employees.row'); } }