<?php

namespace App\Livewire\Admin\AutoRepairManagement\Invoices;

use App\Models\AutoRepairManagement\Invoice;
use Livewire\Component;

class Row extends Component { public Invoice $item; public function render() { return view('livewire.admin.auto-repair-management.invoices.row'); } }