<?php

namespace App\Livewire\Admin\InvoiceItems;

use App\Models\InvoiceItem;
use Livewire\Component;

class Row extends Component { public InvoiceItem $item; public function render() { return view('livewire.admin.invoice-items.row'); } }