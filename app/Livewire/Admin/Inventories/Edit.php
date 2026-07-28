<?php

namespace App\Livewire\Admin\Inventories;

use App\Models\Inventory;
use App\Domain\Inventory\DTOs\InventoryDTO;
use App\Domain\Inventory\Actions\UpdateInventoryAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Edit Inventory')]
class Edit extends Component
{
        use WithPagination;
 public Inventory $item;
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

    public function mount(Inventory $inventory) { $this->item = $inventory; $this->fill($inventory->toArray());  }
    public function render() { abort_if_cannot('edit_inventories'); return view('livewire.admin.inventories.edit', [
            'parts' => $this->getpartsList(),
        ])->layout('components.layouts.app'); }
    public function update(UpdateInventoryAction $action) { $this->validate();  $dto = InventoryDTO::fromArray([
            'part_id' => $this->part_id,
            'quantity' => $this->quantity,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('inventories.updated')); return to_route('admin.inventories.index'); }
    protected function rules(): array { return Inventory::rules($this->item->id); }
}