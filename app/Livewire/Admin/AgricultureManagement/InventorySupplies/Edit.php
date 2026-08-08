<?php

namespace App\Livewire\Admin\AgricultureManagement\InventorySupplies;

use App\Models\AgricultureManagement\InventorySupply;
use App\Domain\AgricultureManagement\InventorySupply\DTOs\InventorySupplyDTO;
use App\Domain\AgricultureManagement\InventorySupply\Actions\UpdateInventorySupplyAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Edit InventorySupply')]
class Edit extends Component
{
        use WithPagination;
 public InventorySupply $item;
    public $name = '';
    public $stock_quantity = '';
    public $unit = '';
   
    public function mount(InventorySupply $inventorySupply) { $this->item = $inventorySupply; $this->fill($inventorySupply->toArray());  }
    public function render() {
        abort_if_cannot('edit_inventory_supplies');
        return view('livewire.admin.agriculture-management.inventory-supplies.edit', [
        ])->layout('components.layouts.app');
    }
    public function update(UpdateInventorySupplyAction $action) { $this->validate();  $dto = InventorySupplyDTO::fromArray([
            'name' => $this->name,
            'stock_quantity' => $this->stock_quantity,
            'unit' => $this->unit,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('agriculture-management/inventory-supplies.updated')); return to_route('admin.agriculture-management.inventory-supplies.index'); }
    protected function rules(): array { return InventorySupply::rules($this->item->id); }
}