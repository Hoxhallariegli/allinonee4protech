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

#[Title('Add InsuranceClaim')]
class Create extends Component
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

    public function render() {
        abort_if_cannot('add_insurance_claims');
        return view('livewire.admin.auto-repair-management.insurance-claims.create', [
            'vehicles' => $this->getvehiclesList(),
        ])->layout('components.layouts.app');
    }
    public function store(CreateInsuranceClaimAction $action) { $this->validate();  $dto = InsuranceClaimDTO::fromArray([
            'vehicle_id' => $this->vehicle_id,
            'policy_number' => $this->policy_number,
            'amount' => $this->amount,
            'status' => $this->status,
        ]); $action->execute($dto); session()->flash('success', __('auto-repair-management/insurance-claims.created')); return to_route('admin.auto-repair-management.insurance-claims.index'); }
    protected function rules(): array { return InsuranceClaim::rules(); }
}