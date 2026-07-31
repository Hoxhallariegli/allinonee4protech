<?php

namespace App\Livewire\Admin\ConstructionERP\Suppliers;

use App\Models\ConstructionERP\Supplier;
use Livewire\Component;

class Row extends Component { public Supplier $item; public function render() { return view('livewire.admin.construction-e-r-p.suppliers.row'); } }