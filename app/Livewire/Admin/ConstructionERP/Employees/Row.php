<?php

namespace App\Livewire\Admin\ConstructionERP\Employees;

use App\Models\ConstructionERP\Employee;
use Livewire\Component;

class Row extends Component { public Employee $item; public function render() { return view('livewire.admin.construction-e-r-p.employees.row'); } }