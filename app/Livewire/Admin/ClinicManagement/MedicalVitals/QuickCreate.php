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

class QuickCreate extends Component
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

    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.clinic-management.medical-vitals.quick-create', [
            'patients' => $this->getpatientsList(),
        ]); }

    public function store(CreateMedicalVitalAction $action)
    {
        $this->validate();
        $dto = MedicalVitalDTO::fromArray([
            'patient_id' => $this->patient_id,
            'weight_kg' => $this->weight_kg,
            'blood_pressure' => $this->blood_pressure,
            'pulse_bpm' => $this->pulse_bpm,
            'temperature_c' => $this->temperature_c,
            'recorded_at' => $this->recorded_at,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('medical-vital-created', id: $item->id);
        $this->js("Livewire.dispatch('medical-vital-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('clinic-management/medical-vitals.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->id ?? $item->id);
        $this->reset(['patient_id', 'weight_kg', 'blood_pressure', 'pulse_bpm', 'temperature_c', 'recorded_at']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return MedicalVital::rules(); }
}