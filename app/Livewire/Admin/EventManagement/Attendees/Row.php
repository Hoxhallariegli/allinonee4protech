<?php

namespace App\Livewire\Admin\EventManagement\Attendees;

use App\Models\EventManagement\Attendee;
use Livewire\Component;

class Row extends Component { public Attendee $item; public function render() { return view('livewire.admin.event-management.attendees.row'); } }