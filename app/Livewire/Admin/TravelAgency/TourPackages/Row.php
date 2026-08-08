<?php

namespace App\Livewire\Admin\TravelAgency\TourPackages;

use App\Models\TravelAgency\TourPackage;
use Livewire\Component;

class Row extends Component { public TourPackage $item; public function render() { return view('livewire.admin.travel-agency.tour-packages.row'); } }