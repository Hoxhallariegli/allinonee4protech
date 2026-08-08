<?php

namespace App\Livewire\Front\FleetManagement;

use Livewire\Component;
use Livewire\Attributes\Title;
use App\Models\FleetManagement\Vehicle;
use App\Models\FleetManagement\Shipment;

#[Title('Global Logistics & Fleet')]
class Landing extends Component
{
    public $shipmentId;
    public $shipmentResult;

    public function trackShipment()
    {
        $this->shipmentResult = Shipment::where('id', $this->shipmentId)->first();
    }

    public function render()
    {
        return view('livewire.front.fleet-management.landing', [
            'vehicles' => Vehicle::take(6)->get(),
        ])->layout('components.layouts.front');
    }
}
