<?php

namespace App\Livewire\Admin\TravelAgency\Clients;

use App\Models\TravelAgency\Client;
use Livewire\Component;

class Row extends Component { public Client $item; public function render() { return view('livewire.admin.travel-agency.clients.row'); } }