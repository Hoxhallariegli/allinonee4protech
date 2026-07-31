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

class QuickCreate extends Component
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

    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.auto-repair-management.job-cards.quick-create', [
            'vehicles' => $this->getvehiclesList(),
            'customers' => $this->getcustomersList(),
            'mechanics' => $this->getmechanicsList(),
        ]); }

    public function store(CreateJobCardAction $action)
    {
        $this->validate();
        $dto = JobCardDTO::fromArray([
            'vehicle_id' => $this->vehicle_id,
            'customer_id' => $this->customer_id,
            'mechanic_id' => $this->mechanic_id,
            'status' => $this->status,
            'opened_at' => $this->opened_at,
            'closed_at' => $this->closed_at,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('job-card-created', id: $item->id);
        $this->js("Livewire.dispatch('job-card-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('auto-repair-management/job-cards.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->id ?? $item->id);
        $this->reset(['vehicle_id', 'customer_id', 'mechanic_id', 'status', 'opened_at', 'closed_at']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return JobCard::rules(); }
}