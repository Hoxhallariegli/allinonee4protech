<?php

namespace App\Livewire\Admin\AutoRepairManagement\JobCards;

use App\Models\AutoRepairManagement\JobCard;
use App\Domain\AutoRepairManagement\JobCard\DTOs\JobCardDTO;
use App\Domain\AutoRepairManagement\JobCard\Actions\CreateJobCardAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Add JobCard')]
class Create extends Component
{
        use WithPagination;
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
    }

    public function updatedCustomerId($value)
    {
        if (!$value) return;
        $related = \App\Models\AutoRepairManagement\Customer::find($value);
        if (!$related) return;
    }

    public function updatedMechanicId($value)
    {
        if (!$value) return;
        $related = \App\Models\AutoRepairManagement\Mechanic::find($value);
        if (!$related) return;
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

    public function render() {
        abort_if_cannot('add_job_cards');
        return view('livewire.admin.auto-repair-management.job-cards.create', [
            'vehicles' => $this->getvehiclesList(),
            'customers' => $this->getcustomersList(),
            'mechanics' => $this->getmechanicsList(),
        ])->layout('components.layouts.app');
    }
    public function store(CreateJobCardAction $action) { $this->validate();  $dto = JobCardDTO::fromArray([
            'vehicle_id' => $this->vehicle_id,
            'customer_id' => $this->customer_id,
            'mechanic_id' => $this->mechanic_id,
            'status' => $this->status,
            'opened_at' => $this->opened_at,
            'closed_at' => $this->closed_at,
        ]); $action->execute($dto); session()->flash('success', __('auto-repair-management/job-cards.created')); return to_route('admin.auto-repair-management.job-cards.index'); }
    protected function rules(): array { return JobCard::rules(); }
}