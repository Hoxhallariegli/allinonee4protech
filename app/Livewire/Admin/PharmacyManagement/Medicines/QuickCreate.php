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

class QuickCreate extends Component
{
        use WithPagination, WithFileUploads;
     public $name = '';
    public $category = '';
    public $price = '';
    public $stock = '';
    public $photo = '';
   
    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.pharmacy-management.medicines.quick-create', [
        ]); }

    public function store(CreateMedicineAction $action)
    {
        $this->validate();
        if ($this->photo && !is_string($this->photo)) { $this->photo = $this->photo->store('uploads/medicines', 'uploads'); }
        $dto = MedicineDTO::fromArray([
            'name' => $this->name,
            'category' => $this->category,
            'price' => $this->price,
            'stock' => $this->stock,
            'photo' => $this->photo,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('medicine-created', id: $item->id);
        $this->js("Livewire.dispatch('medicine-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('pharmacy-management/medicines.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->name ?? $item->id);
        $this->reset(['name', 'category', 'price', 'stock', 'photo']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return Medicine::rules(); }
}