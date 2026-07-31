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

class QuickCreate extends Component
{
        use WithPagination;
     public $name = '';
    public $phone = '';
    public $birth_date = '';
   
    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.clinic-management.patients.quick-create', [
        ]); }

    public function store(CreatePatientAction $action)
    {
        $this->validate();
        $dto = PatientDTO::fromArray([
            'name' => $this->name,
            'phone' => $this->phone,
            'birth_date' => $this->birth_date,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('patient-created', id: $item->id);
        $this->js("Livewire.dispatch('patient-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('clinic-management/patients.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->name ?? $item->id);
        $this->reset(['name', 'phone', 'birth_date']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return Patient::rules(); }
}