<?php

namespace App\Livewire\Admin\HumanResources\Employees;

use App\Models\HumanResources\Employee;
use Livewire\Component;

class Row extends Component { public Employee $item; public function render() { return view('livewire.admin.human-resources.employees.row'); } }