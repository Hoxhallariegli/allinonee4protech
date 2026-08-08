<?php

namespace App\Livewire\Admin\HotelManagement;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('HotelManagement Dashboard')]
class Dashboard extends Component
{
    public function render()
    {
        $chartData = [];
        $chartData['guests'] = collect(range(6, 0))->map(fn($i) => \App\Models\HotelManagement\Guest::whereDate('created_at', now()->subDays($i))->count())->toArray();
        $chartData['hotelRooms'] = collect(range(6, 0))->map(fn($i) => \App\Models\HotelManagement\HotelRoom::whereDate('created_at', now()->subDays($i))->count())->toArray();
        $chartData['housekeepings'] = collect(range(6, 0))->map(fn($i) => \App\Models\HotelManagement\Housekeeping::whereDate('created_at', now()->subDays($i))->count())->toArray();
        $chartData['reservations'] = collect(range(6, 0))->map(fn($i) => \App\Models\HotelManagement\Reservation::whereDate('created_at', now()->subDays($i))->count())->toArray();
        $chartData['roomTypes'] = collect(range(6, 0))->map(fn($i) => (float) \App\Models\HotelManagement\RoomType::whereDate('created_at', now()->subDays($i))->sum('price'))->toArray();

        return view('livewire.admin.hotel-management.dashboard', [
            'stats' => [
            'guests' => \App\Models\HotelManagement\Guest::count(),
            'hotelRooms' => \App\Models\HotelManagement\HotelRoom::count(),
            'housekeepings' => \App\Models\HotelManagement\Housekeeping::count(),
            'reservations' => \App\Models\HotelManagement\Reservation::count(),
            'roomTypes' => \App\Models\HotelManagement\RoomType::count(),
            'roomTypes_sum' => (float) \App\Models\HotelManagement\RoomType::sum('price'),
            ],
            'chartData' => $chartData,
            'days' => collect(range(6, 0))->map(fn($i) => now()->subDays($i)->format('D'))->toArray()
        ]);
    }
}