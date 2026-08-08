<?php

namespace App\Livewire\Admin\CRM\Interactions;

use App\Models\CRM\Interaction;
use Livewire\Component;

class Row extends Component { public Interaction $item; public function render() { return view('livewire.admin.c-r-m.interactions.row'); } }