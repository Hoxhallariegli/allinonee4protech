<?php

namespace App\Livewire\Admin\FleetManagement\Shipments;

use App\Models\FleetManagement\Shipment;
use App\Domain\FleetManagement\Shipment\DTOs\ShipmentDTO;
use App\Domain\FleetManagement\Shipment\Actions\CreateShipmentAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Add Shipment')]
class Create extends Component
{
        use WithPagination;
     public $vehicle_id = '';
    public $driver_id = '';
    public $origin = '';
    public $destination = '';
    public $status = '';
 
    #[On('vehicle-created')] 
    public function refreshVehicles($id) { $this->vehicle_id = $id; $this->updatedVehicleId($id); }

    #[On('driver-created')] 
    public function refreshDrivers($id) { $this->driver_id = $id; $this->updatedDriverId($id); }
 
    public function updatedVehicleId($value)
    {
        if (!$value) return;
        $related = \App\Models\FleetManagement\Vehicle::find($value);
        if (!$related) return;
    }

    public function updatedDriverId($value)
    {
        if (!$value) return;
        $related = \App\Models\FleetManagement\Driver::find($value);
        if (!$related) return;
    }
 
    protected function getvehiclesList() {
        return \App\Models\FleetManagement\Vehicle::pluck('license_plate', 'id')->toArray();
    }

    protected function getdriversList() {
        return \App\Models\FleetManagement\Driver::pluck('name', 'id')->toArray();
    }

    public function render() {
        abort_if_cannot('add_shipments');
        return view('livewire.admin.fleet-management.shipments.create', [
            'vehicles' => $this->getvehiclesList(),
            'drivers' => $this->getdriversList(),
        ])->layout('components.layouts.app');
    }
    public function store(CreateShipmentAction $action) { $this->validate();  $dto = ShipmentDTO::fromArray([
            'vehicle_id' => $this->vehicle_id,
            'driver_id' => $this->driver_id,
            'origin' => $this->origin,
            'destination' => $this->destination,
            'status' => $this->status,
        ]); $action->execute($dto); session()->flash('success', __('fleet-management/shipments.created')); return to_route('admin.fleet-management.shipments.index'); }
    protected function rules(): array { return Shipment::rules(); }
}