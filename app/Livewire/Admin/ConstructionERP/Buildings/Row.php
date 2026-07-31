<?php

namespace App\Livewire\Admin\ConstructionERP\Buildings;

use App\Models\ConstructionERP\Building;
use Livewire\Component;

class Row extends Component { public Building $item; public function render() { return view('livewire.admin.construction-e-r-p.buildings.row'); } }