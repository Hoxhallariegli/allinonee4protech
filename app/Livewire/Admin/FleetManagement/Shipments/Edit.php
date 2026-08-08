<?php

namespace App\Livewire\Admin\FleetManagement\Shipments;

use App\Models\FleetManagement\Shipment;
use App\Domain\FleetManagement\Shipment\DTOs\ShipmentDTO;
use App\Domain\FleetManagement\Shipment\Actions\UpdateShipmentAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Edit Shipment')]
class Edit extends Component
{
        use WithPagination;
 public Shipment $item;
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

    public function mount(Shipment $shipment) { $this->item = $shipment; $this->fill($shipment->toArray());  }
    public function render() {
        abort_if_cannot('edit_shipments');
        return view('livewire.admin.fleet-management.shipments.edit', [
            'vehicles' => $this->getvehiclesList(),
            'drivers' => $this->getdriversList(),
        ])->layout('components.layouts.app');
    }
    public function update(UpdateShipmentAction $action) { $this->validate();  $dto = ShipmentDTO::fromArray([
            'vehicle_id' => $this->vehicle_id,
            'driver_id' => $this->driver_id,
            'origin' => $this->origin,
            'destination' => $this->destination,
            'status' => $this->status,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('fleet-management/shipments.updated')); return to_route('admin.fleet-management.shipments.index'); }
    protected function rules(): array { return Shipment::rules($this->item->id); }
}