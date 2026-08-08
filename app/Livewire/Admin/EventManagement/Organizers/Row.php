<?php

namespace App\Livewire\Admin\EventManagement\Organizers;

use App\Models\EventManagement\Organizer;
use Livewire\Component;

class Row extends Component { public Organizer $item; public function render() { return view('livewire.admin.event-management.organizers.row'); } }