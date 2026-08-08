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

class QuickCreate extends Component
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

    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.human-resources.attendances.quick-create', [
            'employees' => $this->getemployeesList(),
        ]); }

    public function store(CreateAttendanceAction $action)
    {
        $this->validate();
        $dto = AttendanceDTO::fromArray([
            'employee_id' => $this->employee_id,
            'date' => $this->date,
            'clock_in' => $this->clock_in,
            'clock_out' => $this->clock_out,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('attendance-created', id: $item->id);
        $this->js("Livewire.dispatch('attendance-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('human-resources/attendances.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->id ?? $item->id);
        $this->reset(['employee_id', 'date', 'clock_in', 'clock_out']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return Attendance::rules(); }
}