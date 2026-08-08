<?php

namespace App\Livewire\Admin\ClinicManagement\Doctors;

use App\Models\ClinicManagement\Doctor;
use App\Domain\ClinicManagement\Doctor\DTOs\DoctorDTO;
use App\Domain\ClinicManagement\Doctor\Actions\CreateDoctorAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;

#[Title('Add Doctor')]
class Create extends Component
{
        use WithPagination, WithFileUploads;
     public $name = '';
    public $specialization = '';
    public $phone = '';
    public $photo = '';
   
    public function render() {
        abort_if_cannot('add_doctors');
        return view('livewire.admin.clinic-management.doctors.create', [
        ])->layout('components.layouts.app');
    }
    public function store(CreateDoctorAction $action) { $this->validate();         if ($this->photo && !is_string($this->photo)) { $this->photo = $this->photo->store('uploads/doctors', 'uploads'); }
 $dto = DoctorDTO::fromArray([
            'name' => $this->name,
            'specialization' => $this->specialization,
            'phone' => $this->phone,
            'photo' => $this->photo,
        ]); $action->execute($dto); session()->flash('success', __('clinic-management/doctors.created')); return to_route('admin.clinic-management.doctors.index'); }
    protected function rules(): array { return Doctor::rules(); }
}