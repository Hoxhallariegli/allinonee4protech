<?php

namespace App\Livewire\Admin\Employees;

use App\Models\Employee;
use App\Domain\Employee\DTOs\EmployeeDTO;
use App\Domain\Employee\Actions\CreateEmployeeAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Add Employee')]
class Create extends Component
{
        use WithPagination;
     public $name = '';
    public $email = '';
    public $phone = '';
   
    public function render() { abort_if_cannot('add_employees'); return view('livewire.admin.employees.create', [
        ])->layout('components.layouts.app'); }
    public function store(CreateEmployeeAction $action) { $this->validate();  $dto = EmployeeDTO::fromArray([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
        ]); $action->execute($dto); session()->flash('success', __('employees.created')); return to_route('admin.employees.index'); }
    protected function rules(): array { return Employee::rules(); }
}