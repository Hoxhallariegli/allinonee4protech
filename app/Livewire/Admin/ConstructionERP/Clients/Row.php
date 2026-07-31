<?php

namespace App\Livewire\Admin\ConstructionERP\Clients;

use App\Models\ConstructionERP\Client;
use Livewire\Component;

class Row extends Component { public Client $item; public function render() { return view('livewire.admin.construction-e-r-p.clients.row'); } }