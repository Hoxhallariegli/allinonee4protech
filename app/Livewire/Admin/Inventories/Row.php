<?php

namespace App\Livewire\Admin\Inventories;

use App\Models\Inventory;
use Livewire\Component;

class Row extends Component { public Inventory $item; public function render() { return view('livewire.admin.inventories.row'); } }