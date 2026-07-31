<?php

namespace App\Livewire\Admin\ConstructionERP\Apartments;

use App\Models\ConstructionERP\Apartment;
use Livewire\Component;

class Row extends Component { public Apartment $item; public function render() { return view('livewire.admin.construction-e-r-p.apartments.row'); } }