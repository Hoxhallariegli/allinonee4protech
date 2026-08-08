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
use Livewire\WithFileUploads;

class QuickCreate extends Component
{
        use WithPagination, WithFileUploads;
     public $name = '';
    public $position = '';
    public $phone = '';
    public $photo = '';
   
    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.construction-e-r-p.employees.quick-create', [
        ]); }

    public function store(CreateEmployeeAction $action)
    {
        $this->validate();
        if ($this->photo && !is_string($this->photo)) { $this->photo = $this->photo->store('uploads/employees', 'uploads'); }
        $dto = EmployeeDTO::fromArray([
            'name' => $this->name,
            'position' => $this->position,
            'phone' => $this->phone,
            'photo' => $this->photo,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('employee-created', id: $item->id);
        $this->js("Livewire.dispatch('employee-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('construction-e-r-p/employees.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->name ?? $item->id);
        $this->reset(['name', 'position', 'phone', 'photo']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return Employee::rules(); }
}