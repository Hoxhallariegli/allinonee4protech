<?php

namespace App\Livewire\Admin\FleetManagement\FuelLogs;

use App\Models\FleetManagement\FuelLog;
use App\Domain\FleetManagement\FuelLog\DTOs\FuelLogDTO;
use App\Domain\FleetManagement\FuelLog\Actions\CreateFuelLogAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

class QuickCreate extends Component
{
        use WithPagination;
     public $vehicle_id = '';
    public $date = '';
    public $amount = '';
    public $cost = '';
 
    #[On('vehicle-created')] 
    public function refreshVehicles($id) { $this->vehicle_id = $id; $this->updatedVehicleId($id); }
 
    public function updatedVehicleId($value)
    {
        if (!$value) return;
        $related = \App\Models\FleetManagement\Vehicle::find($value);
        if (!$related) return;
    }
 
    protected function getvehiclesList() {
        return \App\Models\FleetManagement\Vehicle::pluck('license_plate', 'id')->toArray();
    }

    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.fleet-management.fuel-logs.quick-create', [
            'vehicles' => $this->getvehiclesList(),
        ]); }

    public function store(CreateFuelLogAction $action)
    {
        $this->validate();
        $dto = FuelLogDTO::fromArray([
            'vehicle_id' => $this->vehicle_id,
            'date' => $this->date,
            'amount' => $this->amount,
            'cost' => $this->cost,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('fuel-log-created', id: $item->id);
        $this->js("Livewire.dispatch('fuel-log-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('fleet-management/fuel-logs.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->id ?? $item->id);
        $this->reset(['vehicle_id', 'date', 'amount', 'cost']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return FuelLog::rules(); }
}