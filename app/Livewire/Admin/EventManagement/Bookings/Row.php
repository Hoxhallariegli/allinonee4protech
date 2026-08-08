<?php

namespace App\Livewire\Admin\EventManagement\Bookings;

use App\Models\EventManagement\Booking;
use Livewire\Component;

class Row extends Component { public Booking $item; public function render() { return view('livewire.admin.event-management.bookings.row'); } }