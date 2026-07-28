<?php

namespace App\Livewire\Admin\Employees;

use App\Models\Employee;
use Livewire\Component;

class Row extends Component { public Employee $item; public function render() { return view('livewire.admin.employees.row'); } }