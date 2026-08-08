<?php

namespace App\Livewire\Admin\ClinicManagement\Visits;

use App\Models\ClinicManagement\Visit;
use App\Domain\ClinicManagement\Visit\DTOs\VisitDTO;
use App\Domain\ClinicManagement\Visit\Actions\CreateVisitAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

class QuickCreate extends Component
{
        use WithPagination;
     public $patient_id = '';
    public $doctor_id = '';
    public $visit_date = '';
    public $diagnosis = '';
 
    #[On('patient-created')] 
    public function refreshPatients($id) { $this->patient_id = $id; $this->updatedPatientId($id); }

    #[On('doctor-created')] 
    public function refreshDoctors($id) { $this->doctor_id = $id; $this->updatedDoctorId($id); }
 
    public function updatedPatientId($value)
    {
        if (!$value) return;
        $related = \App\Models\ClinicManagement\Patient::find($value);
        if (!$related) return;
    }

    public function updatedDoctorId($value)
    {
        if (!$value) return;
        $related = \App\Models\ClinicManagement\Doctor::find($value);
        if (!$related) return;
    }
 
    protected function getpatientsList() {
        return \App\Models\ClinicManagement\Patient::pluck('name', 'id')->toArray();
    }

    protected function getdoctorsList() {
        return \App\Models\ClinicManagement\Doctor::pluck('name', 'id')->toArray();
    }

    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.clinic-management.visits.quick-create', [
            'patients' => $this->getpatientsList(),
            'doctors' => $this->getdoctorsList(),
        ]); }

    public function store(CreateVisitAction $action)
    {
        $this->validate();
        $dto = VisitDTO::fromArray([
            'patient_id' => $this->patient_id,
            'doctor_id' => $this->doctor_id,
            'visit_date' => $this->visit_date,
            'diagnosis' => $this->diagnosis,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('visit-created', id: $item->id);
        $this->js("Livewire.dispatch('visit-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('clinic-management/visits.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->id ?? $item->id);
        $this->reset(['patient_id', 'doctor_id', 'visit_date', 'diagnosis']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return Visit::rules(); }
}