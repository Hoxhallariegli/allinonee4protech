<?php

namespace App\Livewire\Admin\TravelAgency\FlightTickets;

use App\Models\TravelAgency\FlightTicket;
use Livewire\Component;

class Row extends Component { public FlightTicket $item; public function render() { return view('livewire.admin.travel-agency.flight-tickets.row'); } }