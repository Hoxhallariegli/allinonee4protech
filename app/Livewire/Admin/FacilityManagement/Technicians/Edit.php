<?php

namespace App\Livewire\Admin\FacilityManagement\Technicians;

use App\Models\FacilityManagement\Technician;
use App\Domain\FacilityManagement\Technician\DTOs\TechnicianDTO;
use App\Domain\FacilityManagement\Technician\Actions\UpdateTechnicianAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Edit Technician')]
class Edit extends Component
{
        use WithPagination;
 public Technician $item;
    public $name = '';
    public $specialization = '';
   
    public function mount(Technician $technician) { $this->item = $technician; $this->fill($technician->toArray());  }
    public function render() {
        abort_if_cannot('edit_technicians');
        return view('livewire.admin.facility-management.technicians.edit', [
        ])->layout('components.layouts.app');
    }
    public function update(UpdateTechnicianAction $action) { $this->validate();  $dto = TechnicianDTO::fromArray([
            'name' => $this->name,
            'specialization' => $this->specialization,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('facility-management/technicians.updated')); return to_route('admin.facility-management.technicians.index'); }
    protected function rules(): array { return Technician::rules($this->item->id); }
}