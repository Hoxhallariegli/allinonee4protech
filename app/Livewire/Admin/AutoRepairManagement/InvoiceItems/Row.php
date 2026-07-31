<?php

namespace App\Livewire\Admin\AutoRepairManagement\InvoiceItems;

use App\Models\AutoRepairManagement\InvoiceItem;
use Livewire\Component;

class Row extends Component { public InvoiceItem $item; public function render() { return view('livewire.admin.auto-repair-management.invoice-items.row'); } }