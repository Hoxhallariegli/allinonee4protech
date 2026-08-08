<?php

namespace App\Livewire\Admin\HumanResources\LeaveRequests;

use App\Models\HumanResources\LeaveRequest;
use App\Domain\HumanResources\LeaveRequest\DTOs\LeaveRequestDTO;
use App\Domain\HumanResources\LeaveRequest\Actions\UpdateLeaveRequestAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Edit LeaveRequest')]
class Edit extends Component
{
        use WithPagination;
 public LeaveRequest $item;
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

    public function mount(LeaveRequest $leaveRequest) { $this->item = $leaveRequest; $this->fill($leaveRequest->toArray()); $this->start_date = $leaveRequest->start_date?->format('Y-m-d'); $this->end_date = $leaveRequest->end_date?->format('Y-m-d'); }
    public function render() {
        abort_if_cannot('edit_leave_requests');
        return view('livewire.admin.human-resources.leave-requests.edit', [
            'employees' => $this->getemployeesList(),
        ])->layout('components.layouts.app');
    }
    public function update(UpdateLeaveRequestAction $action) { $this->validate();  $dto = LeaveRequestDTO::fromArray([
            'employee_id' => $this->employee_id,
            'leave_type' => $this->leave_type,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'status' => $this->status,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('human-resources/leave-requests.updated')); return to_route('admin.human-resources.leave-requests.index'); }
    protected function rules(): array { return LeaveRequest::rules($this->item->id); }
}