<?php

namespace App\Livewire\Admin\AutoRepairManagement\InsuranceClaims;

use App\Models\AutoRepairManagement\InsuranceClaim;
use App\Domain\AutoRepairManagement\InsuranceClaim\DTOs\InsuranceClaimDTO;
use App\Domain\AutoRepairManagement\InsuranceClaim\Actions\CreateInsuranceClaimAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

class QuickCreate extends Component
{
        use WithPagination;
     public $vehicle_id = '';
    public $policy_number = '';
    public $amount = '';
    public $status = '';
 
    #[On('vehicle-created')] 
    public function refreshVehicles($id) { $this->vehicle_id = $id; $this->updatedVehicleId($id); }
 
    public function updatedVehicleId($value)
    {
        if (!$value) return;
        $related = \App\Models\AutoRepairManagement\Vehicle::find($value);
        if (!$related) return;
    }
 
    protected function getvehiclesList() {
        return \App\Models\AutoRepairManagement\Vehicle::pluck('license_plate', 'id')->toArray();
    }

    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.auto-repair-management.insurance-claims.quick-create', [
            'vehicles' => $this->getvehiclesList(),
        ]); }

    public function store(CreateInsuranceClaimAction $action)
    {
        $this->validate();
        $dto = InsuranceClaimDTO::fromArray([
            'vehicle_id' => $this->vehicle_id,
            'policy_number' => $this->policy_number,
            'amount' => $this->amount,
            'status' => $this->status,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('insurance-claim-created', id: $item->id);
        $this->js("Livewire.dispatch('insurance-claim-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('auto-repair-management/insurance-claims.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->id ?? $item->id);
        $this->reset(['vehicle_id', 'policy_number', 'amount', 'status']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return InsuranceClaim::rules(); }
}