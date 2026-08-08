<?php

namespace App\Livewire\Admin\FleetManagement\Trips;

use App\Models\FleetManagement\Trip;
use App\Domain\FleetManagement\Trip\DTOs\TripDTO;
use App\Domain\FleetManagement\Trip\Actions\UpdateTripAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Edit Trip')]
class Edit extends Component
{
        use WithPagination;
 public Trip $item;
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

    public function mount(Trip $trip) { $this->item = $trip; $this->fill($trip->toArray());  }
    public function render() {
        abort_if_cannot('edit_trips');
        return view('livewire.admin.fleet-management.trips.edit', [
            'vehicles' => $this->getvehiclesList(),
            'drivers' => $this->getdriversList(),
        ])->layout('components.layouts.app');
    }
    public function update(UpdateTripAction $action) { $this->validate();  $dto = TripDTO::fromArray([
            'vehicle_id' => $this->vehicle_id,
            'driver_id' => $this->driver_id,
            'start_location' => $this->start_location,
            'destination' => $this->destination,
            'distance' => $this->distance,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('fleet-management/trips.updated')); return to_route('admin.fleet-management.trips.index'); }
    protected function rules(): array { return Trip::rules($this->item->id); }
}