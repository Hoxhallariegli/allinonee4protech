<?php

namespace App\Livewire\Admin\PharmacyManagement\Suppliers;

use App\Models\PharmacyManagement\Supplier;
use Livewire\Component;

class Row extends Component { public Supplier $item; public function render() { return view('livewire.admin.pharmacy-management.suppliers.row'); } }