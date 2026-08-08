<?php

namespace App\Livewire\Admin\HumanResources\Employees;

use App\Models\HumanResources\Employee;
use App\Domain\HumanResources\Employee\DTOs\EmployeeDTO;
use App\Domain\HumanResources\Employee\Actions\CreateEmployeeAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;

#[Title('Add Employee')]
class Create extends Component
{
        use WithPagination, WithFileUploads;
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

    public function render() {
        abort_if_cannot('add_employees');
        return view('livewire.admin.human-resources.employees.create', [
            'departments' => $this->getdepartmentsList(),
        ])->layout('components.layouts.app');
    }
    public function store(CreateEmployeeAction $action) { $this->validate();         if ($this->photo && !is_string($this->photo)) { $this->photo = $this->photo->store('uploads/employees', 'uploads'); }
 $dto = EmployeeDTO::fromArray([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'department_id' => $this->department_id,
            'hire_date' => $this->hire_date,
            'photo' => $this->photo,
        ]); $action->execute($dto); session()->flash('success', __('human-resources/employees.created')); return to_route('admin.human-resources.employees.index'); }
    protected function rules(): array { return Employee::rules(); }
}