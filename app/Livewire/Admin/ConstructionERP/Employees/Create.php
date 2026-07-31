<?php

namespace App\Livewire\Admin\ConstructionERP\Employees;

use App\Models\ConstructionERP\Employee;
use App\Domain\ConstructionERP\Employee\DTOs\EmployeeDTO;
use App\Domain\ConstructionERP\Employee\Actions\CreateEmployeeAction;
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
    public $position = '';
    public $phone = '';
   
    public function render() { abort_if_cannot('add_employees'); return view('livewire.admin.construction-e-r-p.employees.create', [
        ])->layout('components.layouts.app'); }
    public function store(CreateEmployeeAction $action) { $this->validate();  $dto = EmployeeDTO::fromArray([
            'name' => $this->name,
            'position' => $this->position,
            'phone' => $this->phone,
        ]); $action->execute($dto); session()->flash('success', __('construction-e-r-p/employees.created')); return to_route('admin.construction-e-r-p.employees.index'); }
    protected function rules(): array { return Employee::rules(); }
}