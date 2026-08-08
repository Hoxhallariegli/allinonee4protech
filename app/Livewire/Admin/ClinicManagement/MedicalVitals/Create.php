<?php

namespace App\Livewire\Admin\ClinicManagement\MedicalVitals;

use App\Models\ClinicManagement\MedicalVital;
use App\Domain\ClinicManagement\MedicalVital\DTOs\MedicalVitalDTO;
use App\Domain\ClinicManagement\MedicalVital\Actions\CreateMedicalVitalAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Add MedicalVital')]
class Create extends Component
{
        use WithPagination;
     public $patient_id = '';
    public $weight_kg = '';
    public $blood_pressure = '';
    public $pulse_bpm = '';
    public $temperature_c = '';
    public $recorded_at = '';
 
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
        abort_if_cannot('add_medical_vitals');
        return view('livewire.admin.clinic-management.medical-vitals.create', [
            'patients' => $this->getpatientsList(),
        ])->layout('components.layouts.app');
    }
    public function store(CreateMedicalVitalAction $action) { $this->validate();  $dto = MedicalVitalDTO::fromArray([
            'patient_id' => $this->patient_id,
            'weight_kg' => $this->weight_kg,
            'blood_pressure' => $this->blood_pressure,
            'pulse_bpm' => $this->pulse_bpm,
            'temperature_c' => $this->temperature_c,
            'recorded_at' => $this->recorded_at,
        ]); $action->execute($dto); session()->flash('success', __('clinic-management/medical-vitals.created')); return to_route('admin.clinic-management.medical-vitals.index'); }
    protected function rules(): array { return MedicalVital::rules(); }
}