<?php

namespace App\Livewire\Admin\RealEstateCRM\Agents;

use App\Models\RealEstateCRM\Agent;
use Livewire\Component;

class Row extends Component { public Agent $item; public function render() { return view('livewire.admin.real-estate-c-r-m.agents.row'); } }