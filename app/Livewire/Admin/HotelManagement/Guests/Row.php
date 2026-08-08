<?php

namespace App\Livewire\Admin\HotelManagement\Guests;

use App\Models\HotelManagement\Guest;
use Livewire\Component;

class Row extends Component { public Guest $item; public function render() { return view('livewire.admin.hotel-management.guests.row'); } }