<?php

namespace App\Livewire\Front\TravelAgency;

use Livewire\Component;
use Livewire\Attributes\Title;
use App\Models\TravelAgency\TourPackage;
use App\Models\TravelAgency\Destination;

use App\Models\TravelAgency\FlightTicket;

#[Title('The Travel Station')]
class Landing extends Component
{
    public function render()
    {
        return view('livewire.front.travel-agency.landing', [
            'packages' => TourPackage::all(),
            'destinations' => Destination::all(),
            'flightTickets' => FlightTicket::all(),
        ])->layout('components.layouts.front');
    }
}
