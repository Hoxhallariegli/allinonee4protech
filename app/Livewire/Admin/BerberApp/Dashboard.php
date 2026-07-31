<?php

namespace App\Livewire\Admin\BerberApp;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('BerberApp Dashboard')]
class Dashboard extends Component
{
    public function render()
    {
        $chartData = [];
        $chartData['barbers'] = collect(range(6, 0))->map(fn($i) => \App\Models\BerberApp\Barber::whereDate('created_at', now()->subDays($i))->count())->toArray();
        $chartData['bookings'] = collect(range(6, 0))->map(fn($i) => \App\Models\BerberApp\Booking::whereDate('created_at', now()->subDays($i))->count())->toArray();
        $chartData['reminders'] = collect(range(6, 0))->map(fn($i) => \App\Models\BerberApp\Reminder::whereDate('created_at', now()->subDays($i))->count())->toArray();
        $chartData['services'] = collect(range(6, 0))->map(fn($i) => (float) \App\Models\BerberApp\Service::whereDate('created_at', now()->subDays($i))->sum('price'))->toArray();

        return view('livewire.admin.berber-app.dashboard', [
            'stats' => [
            'barbers' => \App\Models\BerberApp\Barber::count(),
            'bookings' => \App\Models\BerberApp\Booking::count(),
            'reminders' => \App\Models\BerberApp\Reminder::count(),
            'services' => \App\Models\BerberApp\Service::count(),
            'services_sum' => (float) \App\Models\BerberApp\Service::sum('price'),
            ],
            'chartData' => $chartData,
            'days' => collect(range(6, 0))->map(fn($i) => now()->subDays($i)->format('D'))->toArray()
        ])->layout('components.layouts.app');
    }
}