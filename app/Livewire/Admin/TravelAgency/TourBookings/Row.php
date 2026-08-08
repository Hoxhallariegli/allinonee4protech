<?php

namespace App\Livewire\Admin\TravelAgency\TourBookings;

use App\Models\TravelAgency\TourBooking;
use Livewire\Component;

class Row extends Component { public TourBooking $item; public function render() { return view('livewire.admin.travel-agency.tour-bookings.row'); } }