<?php

namespace App\Livewire\Admin\PharmacyManagement\PrescriptionItems;

use App\Models\PharmacyManagement\PrescriptionItem;
use App\Domain\PharmacyManagement\PrescriptionItem\DTOs\PrescriptionItemDTO;
use App\Domain\PharmacyManagement\PrescriptionItem\Actions\CreatePrescriptionItemAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

class QuickCreate extends Component
{
        use WithPagination;
     public $prescription_id = '';
    public $medicine_id = '';
    public $quantity = '';
 
    #[On('prescription-created')] 
    public function refreshPrescriptions($id) { $this->prescription_id = $id; $this->updatedPrescriptionId($id); }

    #[On('medicine-created')] 
    public function refreshMedicines($id) { $this->medicine_id = $id; $this->updatedMedicineId($id); }
 
    public function updatedPrescriptionId($value)
    {
        if (!$value) return;
        $related = \App\Models\PharmacyManagement\Prescription::find($value);
        if (!$related) return;
    }

    public function updatedMedicineId($value)
    {
        if (!$value) return;
        $related = \App\Models\PharmacyManagement\Medicine::find($value);
        if (!$related) return;
    }
 
    protected function getprescriptionsList() {
        return \App\Models\PharmacyManagement\Prescription::pluck('id', 'id')->toArray();
    }

    protected function getmedicinesList() {
        return \App\Models\PharmacyManagement\Medicine::pluck('name', 'id')->toArray();
    }

    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.pharmacy-management.prescription-items.quick-create', [
            'prescriptions' => $this->getprescriptionsList(),
            'medicines' => $this->getmedicinesList(),
        ]); }

    public function store(CreatePrescriptionItemAction $action)
    {
        $this->validate();
        $dto = PrescriptionItemDTO::fromArray([
            'prescription_id' => $this->prescription_id,
            'medicine_id' => $this->medicine_id,
            'quantity' => $this->quantity,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('prescription-item-created', id: $item->id);
        $this->js("Livewire.dispatch('prescription-item-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('pharmacy-management/prescription-items.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->id ?? $item->id);
        $this->reset(['prescription_id', 'medicine_id', 'quantity']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return PrescriptionItem::rules(); }
}