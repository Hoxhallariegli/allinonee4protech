<?php

namespace App\Livewire\Front\EventManagement;

use Livewire\Component;
use Livewire\Attributes\Title;
use App\Models\EventManagement\Event;

use App\Models\EventManagement\Organizer;
use App\Models\EventManagement\TicketType;

#[Title('Elite Events & Galas')]
class Landing extends Component
{
    public function render()
    {
        return view('livewire.front.event-management.landing', [
            'events' => Event::all(),
            'organizers' => Organizer::all(),
            'ticketTypes' => TicketType::all(),
        ])->layout('components.layouts.front');
    }
}
