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

#[Title('Add LeaveRequest')]
class Create extends Component
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

    public function render() {
        abort_if_cannot('add_leave_requests');
        return view('livewire.admin.human-resources.leave-requests.create', [
            'employees' => $this->getemployeesList(),
        ])->layout('components.layouts.app');
    }
    public function store(CreateLeaveRequestAction $action) { $this->validate();  $dto = LeaveRequestDTO::fromArray([
            'employee_id' => $this->employee_id,
            'leave_type' => $this->leave_type,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'status' => $this->status,
        ]); $action->execute($dto); session()->flash('success', __('human-resources/leave-requests.created')); return to_route('admin.human-resources.leave-requests.index'); }
    protected function rules(): array { return LeaveRequest::rules(); }
}