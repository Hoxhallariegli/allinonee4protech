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

class QuickCreate extends Component
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

    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.human-resources.employees.quick-create', [
            'departments' => $this->getdepartmentsList(),
        ]); }

    public function store(CreateEmployeeAction $action)
    {
        $this->validate();
        if ($this->photo && !is_string($this->photo)) { $this->photo = $this->photo->store('uploads/employees', 'uploads'); }
        $dto = EmployeeDTO::fromArray([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'department_id' => $this->department_id,
            'hire_date' => $this->hire_date,
            'photo' => $this->photo,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('employee-created', id: $item->id);
        $this->js("Livewire.dispatch('employee-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('human-resources/employees.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->name ?? $item->id);
        $this->reset(['name', 'email', 'phone', 'department_id', 'hire_date', 'photo']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return Employee::rules(); }
}