<?php

namespace App\Livewire\Admin\EventManagement;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('EventManagement Dashboard')]
class Dashboard extends Component
{
    public function render()
    {
        $chartData = [];
        $chartData['attendees'] = collect(range(6, 0))->map(fn($i) => \App\Models\EventManagement\Attendee::whereDate('created_at', now()->subDays($i))->count())->toArray();
        $chartData['bookings'] = collect(range(6, 0))->map(fn($i) => \App\Models\EventManagement\Booking::whereDate('created_at', now()->subDays($i))->count())->toArray();
        $chartData['events'] = collect(range(6, 0))->map(fn($i) => \App\Models\EventManagement\Event::whereDate('created_at', now()->subDays($i))->count())->toArray();
        $chartData['organizers'] = collect(range(6, 0))->map(fn($i) => \App\Models\EventManagement\Organizer::whereDate('created_at', now()->subDays($i))->count())->toArray();
        $chartData['ticketTypes'] = collect(range(6, 0))->map(fn($i) => (float) \App\Models\EventManagement\TicketType::whereDate('created_at', now()->subDays($i))->sum('price'))->toArray();

        return view('livewire.admin.event-management.dashboard', [
            'stats' => [
            'attendees' => \App\Models\EventManagement\Attendee::count(),
            'bookings' => \App\Models\EventManagement\Booking::count(),
            'events' => \App\Models\EventManagement\Event::count(),
            'organizers' => \App\Models\EventManagement\Organizer::count(),
            'ticketTypes' => \App\Models\EventManagement\TicketType::count(),
            'ticketTypes_sum' => (float) \App\Models\EventManagement\TicketType::sum('price'),
            ],
            'chartData' => $chartData,
            'days' => collect(range(6, 0))->map(fn($i) => now()->subDays($i)->format('D'))->toArray()
        ]);
    }
}