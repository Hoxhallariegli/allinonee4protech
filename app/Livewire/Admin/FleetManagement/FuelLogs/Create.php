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

#[Title('Add FuelLog')]
class Create extends Component
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

    public function render() {
        abort_if_cannot('add_fuel_logs');
        return view('livewire.admin.fleet-management.fuel-logs.create', [
            'vehicles' => $this->getvehiclesList(),
        ])->layout('components.layouts.app');
    }
    public function store(CreateFuelLogAction $action) { $this->validate();  $dto = FuelLogDTO::fromArray([
            'vehicle_id' => $this->vehicle_id,
            'date' => $this->date,
            'amount' => $this->amount,
            'cost' => $this->cost,
        ]); $action->execute($dto); session()->flash('success', __('fleet-management/fuel-logs.created')); return to_route('admin.fleet-management.fuel-logs.index'); }
    protected function rules(): array { return FuelLog::rules(); }
}