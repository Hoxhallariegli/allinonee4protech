<?php

namespace App\Livewire\Admin\FleetManagement\FuelLogs;

use App\Models\FleetManagement\FuelLog;
use App\Domain\FleetManagement\FuelLog\DTOs\FuelLogDTO;
use App\Domain\FleetManagement\FuelLog\Actions\UpdateFuelLogAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Edit FuelLog')]
class Edit extends Component
{
        use WithPagination;
 public FuelLog $item;
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

    public function mount(FuelLog $fuelLog) { $this->item = $fuelLog; $this->fill($fuelLog->toArray()); $this->date = $fuelLog->date?->format('Y-m-d'); }
    public function render() {
        abort_if_cannot('edit_fuel_logs');
        return view('livewire.admin.fleet-management.fuel-logs.edit', [
            'vehicles' => $this->getvehiclesList(),
        ])->layout('components.layouts.app');
    }
    public function update(UpdateFuelLogAction $action) { $this->validate();  $dto = FuelLogDTO::fromArray([
            'vehicle_id' => $this->vehicle_id,
            'date' => $this->date,
            'amount' => $this->amount,
            'cost' => $this->cost,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('fleet-management/fuel-logs.updated')); return to_route('admin.fleet-management.fuel-logs.index'); }
    protected function rules(): array { return FuelLog::rules($this->item->id); }
}