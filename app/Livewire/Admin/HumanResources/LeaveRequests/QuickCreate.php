<?php

namespace App\Livewire\Admin\HumanResources\LeaveRequests;

use App\Models\HumanResources\LeaveRequest;
use App\Domain\HumanResources\LeaveRequest\DTOs\LeaveRequestDTO;
use App\Domain\HumanResources\LeaveRequest\Actions\CreateLeaveRequestAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

class QuickCreate extends Component
{
        use WithPagination;
     public $employee_id = '';
    public $leave_type = '';
    public $start_date = '';
    public $end_date = '';
    public $status = '';
 
    #[On('employee-created')] 
    public function refreshEmployees($id) { $this->employee_id = $id; $this->updatedEmployeeId($id); }
 
    public function updatedEmployeeId($value)
    {
        if (!$value) return;
        $related = \App\Models\HumanResources\Employee::find($value);
        if (!$related) return;
    }
 
    protected function getemployeesList() {
        return \App\Models\HumanResources\Employee::pluck('name', 'id')->toArray();
    }

    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.human-resources.leave-requests.quick-create', [
            'employees' => $this->getemployeesList(),
        ]); }

    public function store(CreateLeaveRequestAction $action)
    {
        $this->validate();
        $dto = LeaveRequestDTO::fromArray([
            'employee_id' => $this->employee_id,
            'leave_type' => $this->leave_type,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'status' => $this->status,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('leave-request-created', id: $item->id);
        $this->js("Livewire.dispatch('leave-request-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('human-resources/leave-requests.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->id ?? $item->id);
        $this->reset(['employee_id', 'leave_type', 'start_date', 'end_date', 'status']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return LeaveRequest::rules(); }
}