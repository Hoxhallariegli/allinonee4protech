<?php

namespace App\Livewire\Admin\ClinicManagement\Patients;

use App\Models\ClinicManagement\Patient;
use App\Domain\ClinicManagement\Patient\DTOs\PatientDTO;
use App\Domain\ClinicManagement\Patient\Actions\CreatePatientAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Add Patient')]
class Create extends Component
{
        use WithPagination;
     public $name = '';
    public $phone = '';
    public $birth_date = '';
   
    public function render() { abort_if_cannot('add_patients'); return view('livewire.admin.clinic-management.patients.create', [
        ])->layout('components.layouts.app'); }
    public function store(CreatePatientAction $action) { $this->validate();  $dto = PatientDTO::fromArray([
            'name' => $this->name,
            'phone' => $this->phone,
            'birth_date' => $this->birth_date,
        ]); $action->execute($dto); session()->flash('success', __('clinic-management/patients.created')); return to_route('admin.clinic-management.patients.index'); }
    protected function rules(): array { return Patient::rules(); }
}