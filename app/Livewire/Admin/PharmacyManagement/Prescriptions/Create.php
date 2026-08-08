<?php

namespace App\Livewire\Admin\PharmacyManagement\Prescriptions;

use App\Models\PharmacyManagement\Prescription;
use App\Domain\PharmacyManagement\Prescription\DTOs\PrescriptionDTO;
use App\Domain\PharmacyManagement\Prescription\Actions\CreatePrescriptionAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;

#[Title('Add Prescription')]
class Create extends Component
{
        use WithPagination, WithFileUploads;
     public $patient_name = '';
    public $doctor_name = '';
    public $date = '';
    public $photo = '';
   
    public function render() {
        abort_if_cannot('add_prescriptions');
        return view('livewire.admin.pharmacy-management.prescriptions.create', [
        ])->layout('components.layouts.app');
    }
    public function store(CreatePrescriptionAction $action) { $this->validate();         if ($this->photo && !is_string($this->photo)) { $this->photo = $this->photo->store('uploads/prescriptions', 'uploads'); }
 $dto = PrescriptionDTO::fromArray([
            'patient_name' => $this->patient_name,
            'doctor_name' => $this->doctor_name,
            'date' => $this->date,
            'photo' => $this->photo,
        ]); $action->execute($dto); session()->flash('success', __('pharmacy-management/prescriptions.created')); return to_route('admin.pharmacy-management.prescriptions.index'); }
    protected function rules(): array { return Prescription::rules(); }
}