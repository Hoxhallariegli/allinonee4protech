<?php

namespace App\Livewire\Admin\HumanResources\Attendances;

use App\Models\HumanResources\Attendance;
use App\Domain\HumanResources\Attendance\DTOs\AttendanceDTO;
use App\Domain\HumanResources\Attendance\Actions\UpdateAttendanceAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Edit Attendance')]
class Edit extends Component
{
        use WithPagination;
 public Attendance $item;
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

    public function mount(Attendance $attendance) { $this->item = $attendance; $this->fill($attendance->toArray()); $this->date = $attendance->date?->format('Y-m-d'); $this->clock_in = $attendance->clock_in?->format('Y-m-d\TH:i'); $this->clock_out = $attendance->clock_out?->format('Y-m-d\TH:i'); }
    public function render() {
        abort_if_cannot('edit_attendances');
        return view('livewire.admin.human-resources.attendances.edit', [
            'employees' => $this->getemployeesList(),
        ])->layout('components.layouts.app');
    }
    public function update(UpdateAttendanceAction $action) { $this->validate();  $dto = AttendanceDTO::fromArray([
            'employee_id' => $this->employee_id,
            'date' => $this->date,
            'clock_in' => $this->clock_in,
            'clock_out' => $this->clock_out,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('human-resources/attendances.updated')); return to_route('admin.human-resources.attendances.index'); }
    protected function rules(): array { return Attendance::rules($this->item->id); }
}