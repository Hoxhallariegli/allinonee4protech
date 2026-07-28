<?php

namespace App\Livewire\Admin\Inventories;

use App\Models\Inventory;
use App\Domain\Inventory\DTOs\InventoryDTO;
use App\Domain\Inventory\Actions\CreateInventoryAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

class QuickCreate extends Component
{
        use WithPagination;
     public $part_id = '';
    public $quantity = '';
 
    #[On('part-created')] 
    public function refreshParts($id) { $this->part_id = $id; $this->updatedPartId($id); }
 
    public function updatedPartId($value)
    {
        if (!$value) return;
        $related = \App\Models\Part::find($value);
        if (!$related) return;
    }
 
    protected function getpartsList() {
        return \App\Models\Part::pluck('name', 'id')->toArray();
    }

    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.inventories.quick-create', [
            'parts' => $this->getpartsList(),
        ]); }

    public function store(CreateInventoryAction $action)
    {
        $this->validate();
        $dto = InventoryDTO::fromArray([
            'part_id' => $this->part_id,
            'quantity' => $this->quantity,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('inventory-created', id: $item->id);
        $this->js("Livewire.dispatch('inventory-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('inventories.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->id ?? $item->id);
        $this->reset(['part_id', 'quantity']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return Inventory::rules(); }
}