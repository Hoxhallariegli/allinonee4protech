<?php

namespace App\Livewire\Admin\FacilityManagement\Technicians;

use App\Models\FacilityManagement\Technician;
use App\Domain\FacilityManagement\Technician\DTOs\TechnicianDTO;
use App\Domain\FacilityManagement\Technician\Actions\CreateTechnicianAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Add Technician')]
class Create extends Component
{
        use WithPagination;
     public $name = '';
    public $specialization = '';
   
    public function render() {
        abort_if_cannot('add_technicians');
        return view('livewire.admin.facility-management.technicians.create', [
        ])->layout('components.layouts.app');
    }
    public function store(CreateTechnicianAction $action) { $this->validate();  $dto = TechnicianDTO::fromArray([
            'name' => $this->name,
            'specialization' => $this->specialization,
        ]); $action->execute($dto); session()->flash('success', __('facility-management/technicians.created')); return to_route('admin.facility-management.technicians.index'); }
    protected function rules(): array { return Technician::rules(); }
}