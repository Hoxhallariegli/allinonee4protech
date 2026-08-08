<?php

namespace App\Livewire\Admin\HumanResources\Departments;

use App\Models\HumanResources\Department;
use App\Domain\HumanResources\Department\DTOs\DepartmentDTO;
use App\Domain\HumanResources\Department\Actions\CreateDepartmentAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Add Department')]
class Create extends Component
{
        use WithPagination;
     public $name = '';
    public $description = '';
   
    public function render() {
        abort_if_cannot('add_departments');
        return view('livewire.admin.human-resources.departments.create', [
        ])->layout('components.layouts.app');
    }
    public function store(CreateDepartmentAction $action) { $this->validate();  $dto = DepartmentDTO::fromArray([
            'name' => $this->name,
            'description' => $this->description,
        ]); $action->execute($dto); session()->flash('success', __('human-resources/departments.created')); return to_route('admin.human-resources.departments.index'); }
    protected function rules(): array { return Department::rules(); }
}