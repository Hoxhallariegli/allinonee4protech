<?php

namespace App\Livewire\Admin\Employees;

use App\Models\Employee;
use App\Domain\Employee\DTOs\EmployeeDTO;
use App\Domain\Employee\Actions\UpdateEmployeeAction;
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
    public $email = '';
    public $phone = '';
   
    public function mount(Employee $employee) { $this->item = $employee; $this->fill($employee->toArray());  }
    public function render() { abort_if_cannot('edit_employees'); return view('livewire.admin.employees.edit', [
        ])->layout('components.layouts.app'); }
    public function update(UpdateEmployeeAction $action) { $this->validate();  $dto = EmployeeDTO::fromArray([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('employees.updated')); return to_route('admin.employees.index'); }
    protected function rules(): array { return Employee::rules($this->item->id); }
}