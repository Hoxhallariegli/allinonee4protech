<?php

namespace App\Livewire\Admin\HumanResources\Departments;

use App\Models\HumanResources\Department;
use App\Domain\HumanResources\Department\DTOs\DepartmentDTO;
use App\Domain\HumanResources\Department\Actions\UpdateDepartmentAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Edit Department')]
class Edit extends Component
{
        use WithPagination;
 public Department $item;
    public $name = '';
    public $description = '';
   
    public function mount(Department $department) { $this->item = $department; $this->fill($department->toArray());  }
    public function render() {
        abort_if_cannot('edit_departments');
        return view('livewire.admin.human-resources.departments.edit', [
        ])->layout('components.layouts.app');
    }
    public function update(UpdateDepartmentAction $action) { $this->validate();  $dto = DepartmentDTO::fromArray([
            'name' => $this->name,
            'description' => $this->description,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('human-resources/departments.updated')); return to_route('admin.human-resources.departments.index'); }
    protected function rules(): array { return Department::rules($this->item->id); }
}