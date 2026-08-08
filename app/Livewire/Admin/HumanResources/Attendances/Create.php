<?php

namespace App\Livewire\Admin\HumanResources\Attendances;

use App\Models\HumanResources\Attendance;
use App\Domain\HumanResources\Attendance\DTOs\AttendanceDTO;
use App\Domain\HumanResources\Attendance\Actions\CreateAttendanceAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Add Attendance')]
class Create extends Component
{
        use WithPagination;
     public $employee_id = '';
    public $date = '';
    public $clock_in = '';
    public $clock_out = '';
 
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
        abort_if_cannot('add_attendances');
        return view('livewire.admin.human-resources.attendances.create', [
            'employees' => $this->getemployeesList(),
        ])->layout('components.layouts.app');
    }
    public function store(CreateAttendanceAction $action) { $this->validate();  $dto = AttendanceDTO::fromArray([
            'employee_id' => $this->employee_id,
            'date' => $this->date,
            'clock_in' => $this->clock_in,
            'clock_out' => $this->clock_out,
        ]); $action->execute($dto); session()->flash('success', __('human-resources/attendances.created')); return to_route('admin.human-resources.attendances.index'); }
    protected function rules(): array { return Attendance::rules(); }
}