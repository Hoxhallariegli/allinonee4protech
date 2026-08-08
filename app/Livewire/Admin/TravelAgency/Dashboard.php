<?php

namespace App\Livewire\Admin\TravelAgency;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('TravelAgency Dashboard')]
class Dashboard extends Component
{
    public function render()
    {
        $chartData = [];
        $chartData['clients'] = collect(range(6, 0))->map(fn($i) => \App\Models\TravelAgency\Client::whereDate('created_at', now()->subDays($i))->count())->toArray();
        $chartData['destinations'] = collect(range(6, 0))->map(fn($i) => \App\Models\TravelAgency\Destination::whereDate('created_at', now()->subDays($i))->count())->toArray();
        $chartData['flightTickets'] = collect(range(6, 0))->map(fn($i) => (float) \App\Models\TravelAgency\FlightTicket::whereDate('created_at', now()->subDays($i))->sum('price'))->toArray();
        $chartData['tourBookings'] = collect(range(6, 0))->map(fn($i) => \App\Models\TravelAgency\TourBooking::whereDate('created_at', now()->subDays($i))->count())->toArray();
        $chartData['tourPackages'] = collect(range(6, 0))->map(fn($i) => (float) \App\Models\TravelAgency\TourPackage::whereDate('created_at', now()->subDays($i))->sum('price'))->toArray();

        return view('livewire.admin.travel-agency.dashboard', [
            'stats' => [
            'clients' => \App\Models\TravelAgency\Client::count(),
            'destinations' => \App\Models\TravelAgency\Destination::count(),
            'flightTickets' => \App\Models\TravelAgency\FlightTicket::count(),
            'flightTickets_sum' => (float) \App\Models\TravelAgency\FlightTicket::sum('price'),
            'tourBookings' => \App\Models\TravelAgency\TourBooking::count(),
            'tourPackages' => \App\Models\TravelAgency\TourPackage::count(),
            'tourPackages_sum' => (float) \App\Models\TravelAgency\TourPackage::sum('price'),
            ],
            'chartData' => $chartData,
            'days' => collect(range(6, 0))->map(fn($i) => now()->subDays($i)->format('D'))->toArray()
        ]);
    }
}