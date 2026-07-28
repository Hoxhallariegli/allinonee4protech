<?php

namespace App\Livewire\Admin\Invoices;

use App\Models\Invoice;
use Livewire\Component;

class Row extends Component { public Invoice $item; public function render() { return view('livewire.admin.invoices.row'); } }