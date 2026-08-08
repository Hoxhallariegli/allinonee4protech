<?php

namespace App\Livewire\Admin\ClinicManagement\PatientAddresses;

use App\Models\ClinicManagement\PatientAddress;
use App\Domain\ClinicManagement\PatientAddress\DTOs\PatientAddressDTO;
use App\Domain\ClinicManagement\PatientAddress\Actions\CreatePatientAddressAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Add PatientAddress')]
class Create extends Component
{
        use WithPagination;
     public $patient_id = '';
    public $line1 = '';
    public $city = '';
 
    #[On('patient-created')] 
    public function refreshPatients($id) { $this->patient_id = $id; $this->updatedPatientId($id); }
 
    public function updatedPatientId($value)
    {
        if (!$value) return;
        $related = \App\Models\ClinicManagement\Patient::find($value);
        if (!$related) return;
    }
 
    protected function getpatientsList() {
        return \App\Models\ClinicManagement\Patient::pluck('name', 'id')->toArray();
    }

    public function render() {
        abort_if_cannot('add_patient_addresses');
        return view('livewire.admin.clinic-management.patient-addresses.create', [
            'patients' => $this->getpatientsList(),
        ])->layout('components.layouts.app');
    }
    public function store(CreatePatientAddressAction $action) { $this->validate();  $dto = PatientAddressDTO::fromArray([
            'patient_id' => $this->patient_id,
            'line1' => $this->line1,
            'city' => $this->city,
        ]); $action->execute($dto); session()->flash('success', __('clinic-management/patient-addresses.created')); return to_route('admin.clinic-management.patient-addresses.index'); }
    protected function rules(): array { return PatientAddress::rules(); }
}