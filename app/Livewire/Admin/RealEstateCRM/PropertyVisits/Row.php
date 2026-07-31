<?php

namespace App\Livewire\Admin\RealEstateCRM\PropertyVisits;

use App\Models\RealEstateCRM\PropertyVisit;
use Livewire\Component;

class Row extends Component { public PropertyVisit $item; public function render() { return view('livewire.admin.real-estate-c-r-m.property-visits.row'); } }