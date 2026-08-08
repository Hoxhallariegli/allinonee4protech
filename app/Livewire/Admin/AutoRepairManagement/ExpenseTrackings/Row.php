<?php

namespace App\Livewire\Admin\AutoRepairManagement\ExpenseTrackings;

use App\Models\AutoRepairManagement\ExpenseTracking;
use Livewire\Component;

class Row extends Component { public ExpenseTracking $item; public function render() { return view('livewire.admin.auto-repair-management.expense-trackings.row'); } }