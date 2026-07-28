<?php

namespace App\Livewire\Admin\Mechanics;

use App\Models\Mechanic;
use App\Domain\Mechanic\DTOs\MechanicDTO;
use App\Domain\Mechanic\Actions\UpdateMechanicAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Edit Mechanic')]
class Edit extends Component
{
        use WithPagination;
 public Mechanic $item;
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

    public function mount(Mechanic $mechanic) { $this->item = $mechanic; $this->fill($mechanic->toArray());  }
    public function render() { abort_if_cannot('edit_mechanics'); return view('livewire.admin.mechanics.edit', [
            'employees' => $this->getemployeesList(),
        ])->layout('components.layouts.app'); }
    public function update(UpdateMechanicAction $action) { $this->validate();  $dto = MechanicDTO::fromArray([
            'employee_id' => $this->employee_id,
            'specialization' => $this->specialization,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('mechanics.updated')); return to_route('admin.mechanics.index'); }
    protected function rules(): array { return Mechanic::rules($this->item->id); }
}