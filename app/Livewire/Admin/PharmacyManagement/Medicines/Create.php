<?php

namespace App\Livewire\Admin\PharmacyManagement\Medicines;

use App\Models\PharmacyManagement\Medicine;
use App\Domain\PharmacyManagement\Medicine\DTOs\MedicineDTO;
use App\Domain\PharmacyManagement\Medicine\Actions\CreateMedicineAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;

#[Title('Add Medicine')]
class Create extends Component
{
        use WithPagination, WithFileUploads;
     public $name = '';
    public $category = '';
    public $price = '';
    public $stock = '';
    public $photo = '';
   
    public function render() {
        abort_if_cannot('add_medicines');
        return view('livewire.admin.pharmacy-management.medicines.create', [
        ])->layout('components.layouts.app');
    }
    public function store(CreateMedicineAction $action) { $this->validate();         if ($this->photo && !is_string($this->photo)) { $this->photo = $this->photo->store('uploads/medicines', 'uploads'); }
 $dto = MedicineDTO::fromArray([
            'name' => $this->name,
            'category' => $this->category,
            'price' => $this->price,
            'stock' => $this->stock,
            'photo' => $this->photo,
        ]); $action->execute($dto); session()->flash('success', __('pharmacy-management/medicines.created')); return to_route('admin.pharmacy-management.medicines.index'); }
    protected function rules(): array { return Medicine::rules(); }
}