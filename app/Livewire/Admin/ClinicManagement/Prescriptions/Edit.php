<?php

namespace App\Livewire\Admin\ClinicManagement\Prescriptions;

use App\Models\ClinicManagement\Prescription;
use App\Domain\ClinicManagement\Prescription\DTOs\PrescriptionDTO;
use App\Domain\ClinicManagement\Prescription\Actions\UpdatePrescriptionAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Edit Prescription')]
class Edit extends Component
{
        use WithPagination;
 public Prescription $item;
    public $visit_id = '';
    public $medicine = '';
    public $dosage = '';
 
    #[On('visit-created')] 
    public function refreshVisits($id) { $this->visit_id = $id; $this->updatedVisitId($id); }
 
    public function updatedVisitId($value)
    {
        if (!$value) return;
        $related = \App\Models\ClinicManagement\Visit::find($value);
        if (!$related) return;
    }
 
    protected function getvisitsList() {
        return \App\Models\ClinicManagement\Visit::pluck('id', 'id')->toArray();
    }

    public function mount(Prescription $prescription) { $this->item = $prescription; $this->fill($prescription->toArray());  }
    public function render() {
        abort_if_cannot('edit_prescriptions');
        return view('livewire.admin.clinic-management.prescriptions.edit', [
            'visits' => $this->getvisitsList(),
        ])->layout('components.layouts.app');
    }
    public function update(UpdatePrescriptionAction $action) { $this->validate();  $dto = PrescriptionDTO::fromArray([
            'visit_id' => $this->visit_id,
            'medicine' => $this->medicine,
            'dosage' => $this->dosage,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('clinic-management/prescriptions.updated')); return to_route('admin.clinic-management.prescriptions.index'); }
    protected function rules(): array { return Prescription::rules($this->item->id); }
}