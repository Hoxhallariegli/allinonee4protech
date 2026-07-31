<?php

namespace App\Livewire\Admin\AutoRepairManagement\JobCards;

use App\Models\AutoRepairManagement\JobCard;
use App\Domain\AutoRepairManagement\JobCard\DTOs\JobCardDTO;
use App\Domain\AutoRepairManagement\JobCard\Actions\UpdateJobCardAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Edit JobCard')]
class Edit extends Component
{
        use WithPagination;
 public JobCard $item;
    public $vehicle_id = '';
    public $customer_id = '';
    public $mechanic_id = '';
    public $status = '';
    public $opened_at = '';
    public $closed_at = '';
 
    #[On('vehicle-created')] 
    public function refreshVehicles($id) { $this->vehicle_id = $id; $this->updatedVehicleId($id); }

    #[On('customer-created')] 
    public function refreshCustomers($id) { $this->customer_id = $id; $this->updatedCustomerId($id); }

    #[On('mechanic-created')] 
    public function refreshMechanics($id) { $this->mechanic_id = $id; $this->updatedMechanicId($id); }
 
    public function updatedVehicleId($value)
    {
        if (!$value) return;
        $related = \App\Models\AutoRepairManagement\Vehicle::find($value);
        if (!$related) return;
        if (isset($related->customer_id)) { $this->customer_id = $related->customer_id; }
        if (isset($related->mechanic_id)) { $this->mechanic_id = $related->mechanic_id; }
    }

    public function updatedCustomerId($value)
    {
        if (!$value) return;
        $related = \App\Models\AutoRepairManagement\Customer::find($value);
        if (!$related) return;
        if (isset($related->vehicle_id)) { $this->vehicle_id = $related->vehicle_id; }
        if (isset($related->mechanic_id)) { $this->mechanic_id = $related->mechanic_id; }
    }

    public function updatedMechanicId($value)
    {
        if (!$value) return;
        $related = \App\Models\AutoRepairManagement\Mechanic::find($value);
        if (!$related) return;
        if (isset($related->vehicle_id)) { $this->vehicle_id = $related->vehicle_id; }
        if (isset($related->customer_id)) { $this->customer_id = $related->customer_id; }
    }
 
    protected function getvehiclesList() {
        return \App\Models\AutoRepairManagement\Vehicle::pluck('license_plate', 'id')->toArray();
    }

    protected function getcustomersList() {
        return \App\Models\AutoRepairManagement\Customer::pluck('name', 'id')->toArray();
    }

    protected function getmechanicsList() {
        return \App\Models\AutoRepairManagement\Mechanic::with('employee')->get()->pluck('employee.name', 'id')->toArray();
    }

    public function mount(JobCard $jobCard) { $this->item = $jobCard; $this->fill($jobCard->toArray()); $this->opened_at = $jobCard->opened_at?->format('Y-m-d\TH:i'); $this->closed_at = $jobCard->closed_at?->format('Y-m-d\TH:i'); }
    public function render() { abort_if_cannot('edit_job_cards'); return view('livewire.admin.auto-repair-management.job-cards.edit', [
            'vehicles' => $this->getvehiclesList(),
            'customers' => $this->getcustomersList(),
            'mechanics' => $this->getmechanicsList(),
        ])->layout('components.layouts.app'); }
    public function update(UpdateJobCardAction $action) { $this->validate();  $dto = JobCardDTO::fromArray([
            'vehicle_id' => $this->vehicle_id,
            'customer_id' => $this->customer_id,
            'mechanic_id' => $this->mechanic_id,
            'status' => $this->status,
            'opened_at' => $this->opened_at,
            'closed_at' => $this->closed_at,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('auto-repair-management/job-cards.updated')); return to_route('admin.auto-repair-management.job-cards.index'); }
    protected function rules(): array { return JobCard::rules($this->item->id); }
}