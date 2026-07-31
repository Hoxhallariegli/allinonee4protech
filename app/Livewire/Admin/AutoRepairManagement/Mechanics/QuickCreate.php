<?php

namespace App\Livewire\Admin\AutoRepairManagement\Mechanics;

use App\Models\AutoRepairManagement\Mechanic;
use App\Domain\AutoRepairManagement\Mechanic\DTOs\MechanicDTO;
use App\Domain\AutoRepairManagement\Mechanic\Actions\CreateMechanicAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

class QuickCreate extends Component
{
        use WithPagination;
     public $employee_id = '';
    public $specialization = '';
 
    #[On('employee-created')] 
    public function refreshEmployees($id) { $this->employee_id = $id; $this->updatedEmployeeId($id); }
 
    public function updatedEmployeeId($value)
    {
        if (!$value) return;
        $related = \App\Models\AutoRepairManagement\Employee::find($value);
        if (!$related) return;
    }
 
    protected function getemployeesList() {
        return \App\Models\AutoRepairManagement\Employee::pluck('name', 'id')->toArray();
    }

    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.auto-repair-management.mechanics.quick-create', [
            'employees' => $this->getemployeesList(),
        ]); }

    public function store(CreateMechanicAction $action)
    {
        $this->validate();
        $dto = MechanicDTO::fromArray([
            'employee_id' => $this->employee_id,
            'specialization' => $this->specialization,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('mechanic-created', id: $item->id);
        $this->js("Livewire.dispatch('mechanic-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('auto-repair-management/mechanics.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->id ?? $item->id);
        $this->reset(['employee_id', 'specialization']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return Mechanic::rules(); }
}