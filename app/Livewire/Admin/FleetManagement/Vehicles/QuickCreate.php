<?php

namespace App\Livewire\Admin\FleetManagement\Vehicles;

use App\Models\FleetManagement\Vehicle;
use App\Domain\FleetManagement\Vehicle\DTOs\VehicleDTO;
use App\Domain\FleetManagement\Vehicle\Actions\CreateVehicleAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;

class QuickCreate extends Component
{
        use WithPagination, WithFileUploads;
     public $make = '';
    public $model = '';
    public $year = '';
    public $license_plate = '';
    public $photo = '';
   
    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.fleet-management.vehicles.quick-create', [
        ]); }

    public function store(CreateVehicleAction $action)
    {
        $this->validate();
        if ($this->photo && !is_string($this->photo)) { $this->photo = $this->photo->store('uploads/vehicles', 'uploads'); }
        $dto = VehicleDTO::fromArray([
            'make' => $this->make,
            'model' => $this->model,
            'year' => $this->year,
            'license_plate' => $this->license_plate,
            'photo' => $this->photo,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('vehicle-created', id: $item->id);
        $this->js("Livewire.dispatch('vehicle-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('fleet-management/vehicles.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->id ?? $item->id);
        $this->reset(['make', 'model', 'year', 'license_plate', 'photo']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return Vehicle::rules(); }
}