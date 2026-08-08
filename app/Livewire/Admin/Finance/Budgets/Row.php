<?php

namespace App\Livewire\Admin\Finance\Budgets;

use App\Models\Finance\Budget;
use Livewire\Component;

class Row extends Component { public Budget $item; public function render() { return view('livewire.admin.finance.budgets.row'); } }