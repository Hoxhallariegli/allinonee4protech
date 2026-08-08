<?php

namespace App\Livewire\Admin\TravelAgency\Destinations;

use App\Models\TravelAgency\Destination;
use Livewire\Component;

class Row extends Component { public Destination $item; public function render() { return view('livewire.admin.travel-agency.destinations.row'); } }