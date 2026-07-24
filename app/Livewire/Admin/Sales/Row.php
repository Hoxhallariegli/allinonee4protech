<?php

namespace App\Livewire\Admin\Sales;

use App\Models\Sale;
use Livewire\Component;

class Row extends Component { public Sale $item; public function render() { return view('livewire.admin.sales.row'); } }