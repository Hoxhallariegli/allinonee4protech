<?php

namespace App\Livewire\Admin\Mechanics;

use App\Models\Mechanic;
use Livewire\Component;

class Row extends Component { public Mechanic $item; public function render() { return view('livewire.admin.mechanics.row'); } }