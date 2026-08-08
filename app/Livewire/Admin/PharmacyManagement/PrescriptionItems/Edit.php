<?php

namespace App\Livewire\Admin\PharmacyManagement\PrescriptionItems;

use App\Models\PharmacyManagement\PrescriptionItem;
use App\Domain\PharmacyManagement\PrescriptionItem\DTOs\PrescriptionItemDTO;
use App\Domain\PharmacyManagement\PrescriptionItem\Actions\UpdatePrescriptionItemAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Edit PrescriptionItem')]
class Edit extends Component
{
        use WithPagination;
 public PrescriptionItem $item;
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

    public function mount(PrescriptionItem $prescriptionItem) { $this->item = $prescriptionItem; $this->fill($prescriptionItem->toArray());  }
    public function render() {
        abort_if_cannot('edit_prescription_items');
        return view('livewire.admin.pharmacy-management.prescription-items.edit', [
            'prescriptions' => $this->getprescriptionsList(),
            'medicines' => $this->getmedicinesList(),
        ])->layout('components.layouts.app');
    }
    public function update(UpdatePrescriptionItemAction $action) { $this->validate();  $dto = PrescriptionItemDTO::fromArray([
            'prescription_id' => $this->prescription_id,
            'medicine_id' => $this->medicine_id,
            'quantity' => $this->quantity,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('pharmacy-management/prescription-items.updated')); return to_route('admin.pharmacy-management.prescription-items.index'); }
    protected function rules(): array { return PrescriptionItem::rules($this->item->id); }
}