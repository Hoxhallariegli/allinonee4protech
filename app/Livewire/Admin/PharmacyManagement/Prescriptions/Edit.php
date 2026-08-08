<?php

namespace App\Livewire\Admin\PharmacyManagement\Prescriptions;

use App\Models\PharmacyManagement\Prescription;
use App\Domain\PharmacyManagement\Prescription\DTOs\PrescriptionDTO;
use App\Domain\PharmacyManagement\Prescription\Actions\UpdatePrescriptionAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;

#[Title('Edit Prescription')]
class Edit extends Component
{
        use WithPagination, WithFileUploads;
 public Prescription $item;
    public $patient_name = '';
    public $doctor_name = '';
    public $date = '';
    public $photo = '';
   
    public function mount(Prescription $prescription) { $this->item = $prescription; $this->fill($prescription->toArray()); $this->date = $prescription->date?->format('Y-m-d'); }
    public function render() {
        abort_if_cannot('edit_prescriptions');
        return view('livewire.admin.pharmacy-management.prescriptions.edit', [
        ])->layout('components.layouts.app');
    }
    public function update(UpdatePrescriptionAction $action) { $this->validate();         if ($this->photo && !is_string($this->photo)) { $this->photo = $this->photo->store('uploads/prescriptions', 'uploads'); }
 $dto = PrescriptionDTO::fromArray([
            'patient_name' => $this->patient_name,
            'doctor_name' => $this->doctor_name,
            'date' => $this->date,
            'photo' => $this->photo,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('pharmacy-management/prescriptions.updated')); return to_route('admin.pharmacy-management.prescriptions.index'); }
    protected function rules(): array { return Prescription::rules($this->item->id); }
}