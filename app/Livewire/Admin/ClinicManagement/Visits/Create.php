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

#[Title('Add Visit')]
class Create extends Component
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
        if (isset($related->doctor_id)) { $this->doctor_id = $related->doctor_id; }
    }

    public function updatedDoctorId($value)
    {
        if (!$value) return;
        $related = \App\Models\ClinicManagement\Doctor::find($value);
        if (!$related) return;
        if (isset($related->patient_id)) { $this->patient_id = $related->patient_id; }
    }
 
    protected function getpatientsList() {
        return \App\Models\ClinicManagement\Patient::pluck('name', 'id')->toArray();
    }

    protected function getdoctorsList() {
        return \App\Models\ClinicManagement\Doctor::pluck('name', 'id')->toArray();
    }

    public function render() { abort_if_cannot('add_visits'); return view('livewire.admin.clinic-management.visits.create', [
            'patients' => $this->getpatientsList(),
            'doctors' => $this->getdoctorsList(),
        ])->layout('components.layouts.app'); }
    public function store(CreateVisitAction $action) { $this->validate();  $dto = VisitDTO::fromArray([
            'patient_id' => $this->patient_id,
            'doctor_id' => $this->doctor_id,
            'visit_date' => $this->visit_date,
            'diagnosis' => $this->diagnosis,
        ]); $action->execute($dto); session()->flash('success', __('clinic-management/visits.created')); return to_route('admin.clinic-management.visits.index'); }
    protected function rules(): array { return Visit::rules(); }
}