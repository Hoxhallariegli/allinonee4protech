<?php

namespace App\Livewire\Admin\ClinicManagement\Prescriptions;

use App\Models\ClinicManagement\Prescription;
use App\Domain\ClinicManagement\Prescription\DTOs\PrescriptionDTO;
use App\Domain\ClinicManagement\Prescription\Actions\CreatePrescriptionAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

class QuickCreate extends Component
{
        use WithPagination;
     public $visit_id = '';
    public $medicine = '';
    public $dosage = '';
 
    #[On('visit-created')] 
    public function refreshVisits($id) { $this->visit_id = $id; $this->updatedVisitId($id); }
 
    public function updatedVisitId($value)
    {
        if (!$value) return;
        $related = \App\Models\ClinicManagement\Visit::find($value);
        if (!$related) return;
    }
 
    protected function getvisitsList() {
        return \App\Models\ClinicManagement\Visit::pluck('id', 'id')->toArray();
    }

    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.clinic-management.prescriptions.quick-create', [
            'visits' => $this->getvisitsList(),
        ]); }

    public function store(CreatePrescriptionAction $action)
    {
        $this->validate();
        $dto = PrescriptionDTO::fromArray([
            'visit_id' => $this->visit_id,
            'medicine' => $this->medicine,
            'dosage' => $this->dosage,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('prescription-created', id: $item->id);
        $this->js("Livewire.dispatch('prescription-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('clinic-management/prescriptions.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->id ?? $item->id);
        $this->reset(['visit_id', 'medicine', 'dosage']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return Prescription::rules(); }
}