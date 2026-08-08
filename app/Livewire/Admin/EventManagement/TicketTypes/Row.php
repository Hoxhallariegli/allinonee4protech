<?php

namespace App\Livewire\Admin\EventManagement\TicketTypes;

use App\Models\EventManagement\TicketType;
use Livewire\Component;

class Row extends Component { public TicketType $item; public function render() { return view('livewire.admin.event-management.ticket-types.row'); } }