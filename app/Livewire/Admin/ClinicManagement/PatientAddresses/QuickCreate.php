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

class QuickCreate extends Component
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

    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.clinic-management.patient-addresses.quick-create', [
            'patients' => $this->getpatientsList(),
        ]); }

    public function store(CreatePatientAddressAction $action)
    {
        $this->validate();
        $dto = PatientAddressDTO::fromArray([
            'patient_id' => $this->patient_id,
            'line1' => $this->line1,
            'city' => $this->city,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('patient-address-created', id: $item->id);
        $this->js("Livewire.dispatch('patient-address-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('clinic-management/patient-addresses.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->id ?? $item->id);
        $this->reset(['patient_id', 'line1', 'city']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return PatientAddress::rules(); }
}