<?php

namespace App\Livewire\Front\HotelManagement;

use Livewire\Component;
use Livewire\Attributes\Title;
use App\Models\HotelManagement\RoomType;

#[Title('The Grand Station Hotel')]
class Landing extends Component
{
    public function render()
    {
        return view('livewire.front.hotel-management.landing', [
            'roomTypes' => RoomType::all(),
        ])->layout('components.layouts.front');
    }
}
