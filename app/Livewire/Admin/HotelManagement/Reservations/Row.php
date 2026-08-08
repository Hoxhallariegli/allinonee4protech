<?php

namespace App\Livewire\Admin\HotelManagement\Reservations;

use App\Models\HotelManagement\Reservation;
use Livewire\Component;

class Row extends Component { public Reservation $item; public function render() { return view('livewire.admin.hotel-management.reservations.row'); } }