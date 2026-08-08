<?php

namespace App\Livewire\Admin\FleetManagement\Trips;

use App\Models\FleetManagement\Trip;
use App\Domain\FleetManagement\Trip\DTOs\TripDTO;
use App\Domain\FleetManagement\Trip\Actions\CreateTripAction;
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
    public $start_location = '';
    public $destination = '';
    public $distance = '';
 
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

    public function render() { return view('livewire.admin.fleet-management.trips.quick-create', [
            'vehicles' => $this->getvehiclesList(),
            'drivers' => $this->getdriversList(),
        ]); }

    public function store(CreateTripAction $action)
    {
        $this->validate();
        $dto = TripDTO::fromArray([
            'vehicle_id' => $this->vehicle_id,
            'driver_id' => $this->driver_id,
            'start_location' => $this->start_location,
            'destination' => $this->destination,
            'distance' => $this->distance,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('trip-created', id: $item->id);
        $this->js("Livewire.dispatch('trip-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('fleet-management/trips.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->id ?? $item->id);
        $this->reset(['vehicle_id', 'driver_id', 'start_location', 'destination', 'distance']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return Trip::rules(); }
}