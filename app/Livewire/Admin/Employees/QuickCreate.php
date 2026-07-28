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

class QuickCreate extends Component
{
        use WithPagination;
     public $name = '';
    public $email = '';
    public $phone = '';
   
    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.employees.quick-create', [
        ]); }

    public function store(CreateEmployeeAction $action)
    {
        $this->validate();
        $dto = EmployeeDTO::fromArray([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('employee-created', id: $item->id);
        $this->js("Livewire.dispatch('employee-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('employees.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->name ?? $item->id);
        $this->reset(['name', 'email', 'phone']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return Employee::rules(); }
}