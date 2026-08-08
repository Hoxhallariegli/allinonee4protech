<?php

namespace App\Livewire\Admin\EventManagement\Events;

use App\Models\EventManagement\Event;
use Livewire\Component;

class Row extends Component { public Event $item; public function render() { return view('livewire.admin.event-management.events.row'); } }