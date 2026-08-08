<?php

namespace App\Livewire\Admin\ClinicManagement\Doctors;

use App\Models\ClinicManagement\Doctor;
use App\Domain\ClinicManagement\Doctor\DTOs\DoctorDTO;
use App\Domain\ClinicManagement\Doctor\Actions\UpdateDoctorAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;

#[Title('Edit Doctor')]
class Edit extends Component
{
        use WithPagination, WithFileUploads;
 public Doctor $item;
    public $name = '';
    public $specialization = '';
    public $phone = '';
    public $photo = '';
   
    public function mount(Doctor $doctor) { $this->item = $doctor; $this->fill($doctor->toArray());  }
    public function render() {
        abort_if_cannot('edit_doctors');
        return view('livewire.admin.clinic-management.doctors.edit', [
        ])->layout('components.layouts.app');
    }
    public function update(UpdateDoctorAction $action) { $this->validate();         if ($this->photo && !is_string($this->photo)) { $this->photo = $this->photo->store('uploads/doctors', 'uploads'); }
 $dto = DoctorDTO::fromArray([
            'name' => $this->name,
            'specialization' => $this->specialization,
            'phone' => $this->phone,
            'photo' => $this->photo,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('clinic-management/doctors.updated')); return to_route('admin.clinic-management.doctors.index'); }
    protected function rules(): array { return Doctor::rules($this->item->id); }
}