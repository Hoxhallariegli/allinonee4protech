<?php

namespace App\Livewire\Admin\ConstructionERP\HeavyMachineries;

use App\Models\ConstructionERP\HeavyMachinery;
use Livewire\Component;

class Row extends Component { public HeavyMachinery $item; public function render() { return view('livewire.admin.construction-e-r-p.heavy-machineries.row'); } }