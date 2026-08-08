<?php

namespace App\Livewire\Admin\FleetManagement\Shipments;

use App\Models\FleetManagement\Shipment;
use Livewire\Component;

class Row extends Component { public Shipment $item; public function render() { return view('livewire.admin.fleet-management.shipments.row'); } }