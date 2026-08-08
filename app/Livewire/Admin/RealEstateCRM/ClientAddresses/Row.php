<?php

namespace App\Livewire\Admin\RealEstateCRM\ClientAddresses;

use App\Models\RealEstateCRM\ClientAddress;
use Livewire\Component;

class Row extends Component { public ClientAddress $item; public function render() { return view('livewire.admin.real-estate-c-r-m.client-addresses.row'); } }