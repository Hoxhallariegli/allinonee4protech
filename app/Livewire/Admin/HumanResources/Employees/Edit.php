<?php

namespace App\Livewire\Admin\HumanResources\Employees;

use App\Models\HumanResources\Employee;
use App\Domain\HumanResources\Employee\DTOs\EmployeeDTO;
use App\Domain\HumanResources\Employee\Actions\UpdateEmployeeAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;

#[Title('Edit Employee')]
class Edit extends Component
{
        use WithPagination, WithFileUploads;
 public Employee $item;
    public $name = '';
    public $email = '';
    public $phone = '';
    public $department_id = '';
    public $hire_date = '';
    public $photo = '';
 
    #[On('department-created')] 
    public function refreshDepartments($id) { $this->department_id = $id; $this->updatedDepartmentId($id); }
 
    public function updatedDepartmentId($value)
    {
        if (!$value) return;
        $related = \App\Models\HumanResources\Department::find($value);
        if (!$related) return;
    }
 
    protected function getdepartmentsList() {
        return \App\Models\HumanResources\Department::pluck('name', 'id')->toArray();
    }

    public function mount(Employee $employee) { $this->item = $employee; $this->fill($employee->toArray()); $this->hire_date = $employee->hire_date?->format('Y-m-d'); }
    public function render() {
        abort_if_cannot('edit_employees');
        return view('livewire.admin.human-resources.employees.edit', [
            'departments' => $this->getdepartmentsList(),
        ])->layout('components.layouts.app');
    }
    public function update(UpdateEmployeeAction $action) { $this->validate();         if ($this->photo && !is_string($this->photo)) { $this->photo = $this->photo->store('uploads/employees', 'uploads'); }
 $dto = EmployeeDTO::fromArray([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'department_id' => $this->department_id,
            'hire_date' => $this->hire_date,
            'photo' => $this->photo,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('human-resources/employees.updated')); return to_route('admin.human-resources.employees.index'); }
    protected function rules(): array { return Employee::rules($this->item->id); }
}