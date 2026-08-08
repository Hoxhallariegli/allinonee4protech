<?php

namespace App\Livewire\Admin\PharmacyManagement\Sales;

use App\Models\PharmacyManagement\Sale;
use Livewire\Component;

class Row extends Component { public Sale $item; public function render() { return view('livewire.admin.pharmacy-management.sales.row'); } }