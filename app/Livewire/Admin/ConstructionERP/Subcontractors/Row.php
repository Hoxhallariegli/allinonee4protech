<?php

namespace App\Livewire\Admin\ConstructionERP\Subcontractors;

use App\Models\ConstructionERP\Subcontractor;
use Livewire\Component;

class Row extends Component { public Subcontractor $item; public function render() { return view('livewire.admin.construction-e-r-p.subcontractors.row'); } }