<?php

namespace App\Livewire\Admin\WarehouseManagement\Employees;

use App\Models\WarehouseManagement\Employee;
use App\Domain\WarehouseManagement\Employee\DTOs\EmployeeDTO;
use App\Domain\WarehouseManagement\Employee\Actions\UpdateEmployeeAction;
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
    public $position = '';
    public $salary = '';
    public $hire_date = '';
    public $photo = '';
   
    public function mount(Employee $employee) { $this->item = $employee; $this->fill($employee->toArray()); $this->hire_date = $employee->hire_date?->format('Y-m-d'); }
    public function render() { abort_if_cannot('edit_employees'); return view('livewire.admin.warehouse-management.employees.edit', [
        ]); }
    public function update(UpdateEmployeeAction $action) { $this->validate();         if ($this->photo && !is_string($this->photo)) { $this->photo = $this->photo->store('uploads/employees', 'uploads'); }
 $dto = EmployeeDTO::fromArray([
            'name' => $this->name,
            'position' => $this->position,
            'salary' => $this->salary,
            'hire_date' => $this->hire_date,
            'photo' => $this->photo,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('warehouse-management/employees.updated')); return to_route('admin.warehouse-management.employees.index'); }
    protected function rules(): array { return Employee::rules($this->item->id); }
}