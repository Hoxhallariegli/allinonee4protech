<?php

namespace App\Livewire\Admin\HotelManagement\RoomTypes;

use App\Models\HotelManagement\RoomType;
use Livewire\Component;

class Row extends Component { public RoomType $item; public function render() { return view('livewire.admin.hotel-management.room-types.row'); } }