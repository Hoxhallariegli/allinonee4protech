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

class QuickCreate extends Component
{
        use WithPagination;
     public $name = '';
    public $description = '';
   
    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.human-resources.departments.quick-create', [
        ]); }

    public function store(CreateDepartmentAction $action)
    {
        $this->validate();
        $dto = DepartmentDTO::fromArray([
            'name' => $this->name,
            'description' => $this->description,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('department-created', id: $item->id);
        $this->js("Livewire.dispatch('department-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('human-resources/departments.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->name ?? $item->id);
        $this->reset(['name', 'description']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return Department::rules(); }
}