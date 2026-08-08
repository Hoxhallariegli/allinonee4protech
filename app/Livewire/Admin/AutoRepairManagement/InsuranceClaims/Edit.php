<?php

namespace App\Livewire\Admin\AutoRepairManagement\InsuranceClaims;

use App\Models\AutoRepairManagement\InsuranceClaim;
use App\Domain\AutoRepairManagement\InsuranceClaim\DTOs\InsuranceClaimDTO;
use App\Domain\AutoRepairManagement\InsuranceClaim\Actions\UpdateInsuranceClaimAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Edit InsuranceClaim')]
class Edit extends Component
{
        use WithPagination;
 public InsuranceClaim $item;
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

    public function mount(InsuranceClaim $insuranceClaim) { $this->item = $insuranceClaim; $this->fill($insuranceClaim->toArray());  }
    public function render() {
        abort_if_cannot('edit_insurance_claims');
        return view('livewire.admin.auto-repair-management.insurance-claims.edit', [
            'vehicles' => $this->getvehiclesList(),
        ])->layout('components.layouts.app');
    }
    public function update(UpdateInsuranceClaimAction $action) { $this->validate();  $dto = InsuranceClaimDTO::fromArray([
            'vehicle_id' => $this->vehicle_id,
            'policy_number' => $this->policy_number,
            'amount' => $this->amount,
            'status' => $this->status,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('auto-repair-management/insurance-claims.updated')); return to_route('admin.auto-repair-management.insurance-claims.index'); }
    protected function rules(): array { return InsuranceClaim::rules($this->item->id); }
}