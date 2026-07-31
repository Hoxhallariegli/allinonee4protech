<?php

namespace App\Livewire\Admin\AutoRepairManagement\Inventories;

use App\Models\AutoRepairManagement\Inventory;
use App\Domain\AutoRepairManagement\Inventory\DTOs\InventoryDTO;
use App\Domain\AutoRepairManagement\Inventory\Actions\CreateInventoryAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Add Inventory')]
class Create extends Component
{
        use WithPagination;
     public $part_id = '';
    public $quantity = '';
 
    #[On('part-created')] 
    public function refreshParts($id) { $this->part_id = $id; $this->updatedPartId($id); }
 
    public function updatedPartId($value)
    {
        if (!$value) return;
        $related = \App\Models\AutoRepairManagement\Part::find($value);
        if (!$related) return;
    }
 
    protected function getpartsList() {
        return \App\Models\AutoRepairManagement\Part::pluck('name', 'id')->toArray();
    }

    public function render() { abort_if_cannot('add_inventories'); return view('livewire.admin.auto-repair-management.inventories.create', [
            'parts' => $this->getpartsList(),
        ])->layout('components.layouts.app'); }
    public function store(CreateInventoryAction $action) { $this->validate();  $dto = InventoryDTO::fromArray([
            'part_id' => $this->part_id,
            'quantity' => $this->quantity,
        ]); $action->execute($dto); session()->flash('success', __('auto-repair-management/inventories.created')); return to_route('admin.auto-repair-management.inventories.index'); }
    protected function rules(): array { return Inventory::rules(); }
}