<?php

namespace App\Livewire\Admin\ConstructionERP\Materials;

use App\Models\ConstructionERP\Material;
use Livewire\Component;

class Row extends Component { public Material $item; public function render() { return view('livewire.admin.construction-e-r-p.materials.row'); } }