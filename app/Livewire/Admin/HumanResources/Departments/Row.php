<?php

namespace App\Livewire\Admin\HumanResources\Departments;

use App\Models\HumanResources\Department;
use Livewire\Component;

class Row extends Component { public Department $item; public function render() { return view('livewire.admin.human-resources.departments.row'); } }