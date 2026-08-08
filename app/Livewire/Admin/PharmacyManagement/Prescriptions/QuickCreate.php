<?php

namespace App\Livewire\Admin\PharmacyManagement\Prescriptions;

use App\Models\PharmacyManagement\Prescription;
use App\Domain\PharmacyManagement\Prescription\DTOs\PrescriptionDTO;
use App\Domain\PharmacyManagement\Prescription\Actions\CreatePrescriptionAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;

class QuickCreate extends Component
{
        use WithPagination, WithFileUploads;
     public $patient_name = '';
    public $doctor_name = '';
    public $date = '';
    public $photo = '';
   
    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.pharmacy-management.prescriptions.quick-create', [
        ]); }

    public function store(CreatePrescriptionAction $action)
    {
        $this->validate();
        if ($this->photo && !is_string($this->photo)) { $this->photo = $this->photo->store('uploads/prescriptions', 'uploads'); }
        $dto = PrescriptionDTO::fromArray([
            'patient_name' => $this->patient_name,
            'doctor_name' => $this->doctor_name,
            'date' => $this->date,
            'photo' => $this->photo,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('prescription-created', id: $item->id);
        $this->js("Livewire.dispatch('prescription-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('pharmacy-management/prescriptions.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->id ?? $item->id);
        $this->reset(['patient_name', 'doctor_name', 'date', 'photo']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return Prescription::rules(); }
}