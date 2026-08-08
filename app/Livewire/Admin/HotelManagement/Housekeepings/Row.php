<?php

namespace App\Livewire\Admin\HotelManagement\Housekeepings;

use App\Models\HotelManagement\Housekeeping;
use Livewire\Component;

class Row extends Component { public Housekeeping $item; public function render() { return view('livewire.admin.hotel-management.housekeepings.row'); } }