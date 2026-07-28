<?php

namespace App\Livewire\Admin\Mechanics;

use App\Models\Mechanic;
use App\Domain\Mechanic\DTOs\MechanicDTO;
use App\Domain\Mechanic\Actions\CreateMechanicAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Add Mechanic')]
class Create extends Component
{
        use WithPagination;
     public $employee_id = '';
    public $specialization = '';
 
    #[On('employee-created')] 
    public function refreshEmployees($id) { $this->employee_id = $id; $this->updatedEmployeeId($id); }
 
    public function updatedEmployeeId($value)
    {
        if (!$value) return;
        $related = \App\Models\Employee::find($value);
        if (!$related) return;
    }
 
    protected function getemployeesList() {
        return \App\Models\Employee::pluck('name', 'id')->toArray();
    }

    public function render() { abort_if_cannot('add_mechanics'); return view('livewire.admin.mechanics.create', [
            'employees' => $this->getemployeesList(),
        ])->layout('components.layouts.app'); }
    public function store(CreateMechanicAction $action) { $this->validate();  $dto = MechanicDTO::fromArray([
            'employee_id' => $this->employee_id,
            'specialization' => $this->specialization,
        ]); $action->execute($dto); session()->flash('success', __('mechanics.created')); return to_route('admin.mechanics.index'); }
    protected function rules(): array { return Mechanic::rules(); }
}