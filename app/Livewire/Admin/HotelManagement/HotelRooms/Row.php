<?php

namespace App\Livewire\Admin\HotelManagement\HotelRooms;

use App\Models\HotelManagement\HotelRoom;
use Livewire\Component;

class Row extends Component { public HotelRoom $item; public function render() { return view('livewire.admin.hotel-management.hotel-rooms.row'); } }