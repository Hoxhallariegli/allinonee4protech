<?php

namespace App\Livewire\Admin\ConstructionERP\Employees;

use App\Models\ConstructionERP\Employee;
use App\Domain\ConstructionERP\Employee\DTOs\EmployeeDTO;
use App\Domain\ConstructionERP\Employee\Actions\UpdateEmployeeAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Edit Employee')]
class Edit extends Component
{
        use WithPagination;
 public Employee $item;
    public $name = '';
    public $position = '';
    public $phone = '';
   
    public function mount(Employee $employee) { $this->item = $employee; $this->fill($employee->toArray());  }
    public function render() { abort_if_cannot('edit_employees'); return view('livewire.admin.construction-e-r-p.employees.edit', [
        ])->layout('components.layouts.app'); }
    public function update(UpdateEmployeeAction $action) { $this->validate();  $dto = EmployeeDTO::fromArray([
            'name' => $this->name,
            'position' => $this->position,
            'phone' => $this->phone,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('construction-e-r-p/employees.updated')); return to_route('admin.construction-e-r-p.employees.index'); }
    protected function rules(): array { return Employee::rules($this->item->id); }
}