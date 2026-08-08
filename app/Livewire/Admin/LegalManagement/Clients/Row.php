<?php

namespace App\Livewire\Admin\LegalManagement\Clients;

use App\Models\LegalManagement\Client;
use Livewire\Component;

class Row extends Component { public Client $item; public function render() { return view('livewire.admin.legal-management.clients.row'); } }