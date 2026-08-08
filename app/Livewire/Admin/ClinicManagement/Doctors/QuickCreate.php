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

class QuickCreate extends Component
{
        use WithPagination, WithFileUploads;
     public $name = '';
    public $specialization = '';
    public $phone = '';
    public $photo = '';
   
    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.clinic-management.doctors.quick-create', [
        ]); }

    public function store(CreateDoctorAction $action)
    {
        $this->validate();
        if ($this->photo && !is_string($this->photo)) { $this->photo = $this->photo->store('uploads/doctors', 'uploads'); }
        $dto = DoctorDTO::fromArray([
            'name' => $this->name,
            'specialization' => $this->specialization,
            'phone' => $this->phone,
            'photo' => $this->photo,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('doctor-created', id: $item->id);
        $this->js("Livewire.dispatch('doctor-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('clinic-management/doctors.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->name ?? $item->id);
        $this->reset(['name', 'specialization', 'phone', 'photo']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return Doctor::rules(); }
}