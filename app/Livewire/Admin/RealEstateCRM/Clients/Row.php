<?php

namespace App\Livewire\Admin\RealEstateCRM\Clients;

use App\Models\RealEstateCRM\Client;
use Livewire\Component;

class Row extends Component { public Client $item; public function render() { return view('livewire.admin.real-estate-c-r-m.clients.row'); } }