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

class QuickCreate extends Component
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

    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.fleet-management.shipments.quick-create', [
            'vehicles' => $this->getvehiclesList(),
            'drivers' => $this->getdriversList(),
        ]); }

    public function store(CreateShipmentAction $action)
    {
        $this->validate();
        $dto = ShipmentDTO::fromArray([
            'vehicle_id' => $this->vehicle_id,
            'driver_id' => $this->driver_id,
            'origin' => $this->origin,
            'destination' => $this->destination,
            'status' => $this->status,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('shipment-created', id: $item->id);
        $this->js("Livewire.dispatch('shipment-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('fleet-management/shipments.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->id ?? $item->id);
        $this->reset(['vehicle_id', 'driver_id', 'origin', 'destination', 'status']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return Shipment::rules(); }
}