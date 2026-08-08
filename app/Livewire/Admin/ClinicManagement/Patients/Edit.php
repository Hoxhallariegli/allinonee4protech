<?php

namespace App\Livewire\Admin\ClinicManagement\Patients;

use App\Models\ClinicManagement\Patient;
use App\Domain\ClinicManagement\Patient\DTOs\PatientDTO;
use App\Domain\ClinicManagement\Patient\Actions\UpdatePatientAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;

#[Title('Edit Patient')]
class Edit extends Component
{
        use WithPagination, WithFileUploads;
 public Patient $item;
    public $name = '';
    public $phone = '';
    public $birth_date = '';
    public $photo = '';
   
    public function mount(Patient $patient) { $this->item = $patient; $this->fill($patient->toArray()); $this->birth_date = $patient->birth_date?->format('Y-m-d'); }
    public function render() {
        abort_if_cannot('edit_patients');
        return view('livewire.admin.clinic-management.patients.edit', [
        ])->layout('components.layouts.app');
    }
    public function update(UpdatePatientAction $action) { $this->validate();         if ($this->photo && !is_string($this->photo)) { $this->photo = $this->photo->store('uploads/patients', 'uploads'); }
 $dto = PatientDTO::fromArray([
            'name' => $this->name,
            'phone' => $this->phone,
            'birth_date' => $this->birth_date,
            'photo' => $this->photo,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('clinic-management/patients.updated')); return to_route('admin.clinic-management.patients.index'); }
    protected function rules(): array { return Patient::rules($this->item->id); }
}