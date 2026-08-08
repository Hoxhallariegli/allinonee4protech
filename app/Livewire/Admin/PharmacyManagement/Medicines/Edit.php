<?php

namespace App\Livewire\Admin\PharmacyManagement\Medicines;

use App\Models\PharmacyManagement\Medicine;
use App\Domain\PharmacyManagement\Medicine\DTOs\MedicineDTO;
use App\Domain\PharmacyManagement\Medicine\Actions\UpdateMedicineAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;

#[Title('Edit Medicine')]
class Edit extends Component
{
        use WithPagination, WithFileUploads;
 public Medicine $item;
    public $name = '';
    public $category = '';
    public $price = '';
    public $stock = '';
    public $photo = '';
   
    public function mount(Medicine $medicine) { $this->item = $medicine; $this->fill($medicine->toArray());  }
    public function render() {
        abort_if_cannot('edit_medicines');
        return view('livewire.admin.pharmacy-management.medicines.edit', [
        ])->layout('components.layouts.app');
    }
    public function update(UpdateMedicineAction $action) { $this->validate();         if ($this->photo && !is_string($this->photo)) { $this->photo = $this->photo->store('uploads/medicines', 'uploads'); }
 $dto = MedicineDTO::fromArray([
            'name' => $this->name,
            'category' => $this->category,
            'price' => $this->price,
            'stock' => $this->stock,
            'photo' => $this->photo,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('pharmacy-management/medicines.updated')); return to_route('admin.pharmacy-management.medicines.index'); }
    protected function rules(): array { return Medicine::rules($this->item->id); }
}