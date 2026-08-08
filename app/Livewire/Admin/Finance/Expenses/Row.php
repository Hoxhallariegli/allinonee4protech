<?php

namespace App\Livewire\Admin\Finance\Expenses;

use App\Models\Finance\Expense;
use Livewire\Component;

class Row extends Component { public Expense $item; public function render() { return view('livewire.admin.finance.expenses.row'); } }