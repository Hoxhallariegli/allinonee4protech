<?php

namespace App\Livewire\Admin\ConstructionERP\ClientAddresses;

use App\Models\ConstructionERP\ClientAddress;
use Livewire\Component;

class Row extends Component { public ClientAddress $item; public function render() { return view('livewire.admin.construction-e-r-p.client-addresses.row'); } }