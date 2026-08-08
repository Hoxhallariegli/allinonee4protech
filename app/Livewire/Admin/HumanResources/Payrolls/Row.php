<?php

namespace App\Livewire\Admin\HumanResources\Payrolls;

use App\Models\HumanResources\Payroll;
use Livewire\Component;

class Row extends Component { public Payroll $item; public function render() { return view('livewire.admin.human-resources.payrolls.row'); } }