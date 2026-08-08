<?php

namespace App\Livewire\Admin\WarehouseManagement\Employees;

use App\Models\WarehouseManagement\Employee;
use App\Domain\WarehouseManagement\Employee\DTOs\EmployeeDTO;
use App\Domain\WarehouseManagement\Employee\Actions\CreateEmployeeAction;
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
    public $position = '';
    public $salary = '';
    public $hire_date = '';
    public $photo = '';
   
    public function render() { abort_if_cannot('add_employees'); return view('livewire.admin.warehouse-management.employees.create', [
        ]); }
    public function store(CreateEmployeeAction $action) { $this->validate();         if ($this->photo && !is_string($this->photo)) { $this->photo = $this->photo->store('uploads/employees', 'uploads'); }
 $dto = EmployeeDTO::fromArray([
            'name' => $this->name,
            'position' => $this->position,
            'salary' => $this->salary,
            'hire_date' => $this->hire_date,
            'photo' => $this->photo,
        ]); $action->execute($dto); session()->flash('success', __('warehouse-management/employees.created')); return to_route('admin.warehouse-management.employees.index'); }
    protected function rules(): array { return Employee::rules(); }
}