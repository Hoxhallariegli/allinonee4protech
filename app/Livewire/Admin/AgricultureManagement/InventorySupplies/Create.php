<?php

namespace App\Livewire\Admin\AgricultureManagement\InventorySupplies;

use App\Models\AgricultureManagement\InventorySupply;
use App\Domain\AgricultureManagement\InventorySupply\DTOs\InventorySupplyDTO;
use App\Domain\AgricultureManagement\InventorySupply\Actions\CreateInventorySupplyAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Add InventorySupply')]
class Create extends Component
{
        use WithPagination;
     public $name = '';
    public $stock_quantity = '';
    public $unit = '';
   
    public function render() {
        abort_if_cannot('add_inventory_supplies');
        return view('livewire.admin.agriculture-management.inventory-supplies.create', [
        ])->layout('components.layouts.app');
    }
    public function store(CreateInventorySupplyAction $action) { $this->validate();  $dto = InventorySupplyDTO::fromArray([
            'name' => $this->name,
            'stock_quantity' => $this->stock_quantity,
            'unit' => $this->unit,
        ]); $action->execute($dto); session()->flash('success', __('agriculture-management/inventory-supplies.created')); return to_route('admin.agriculture-management.inventory-supplies.index'); }
    protected function rules(): array { return InventorySupply::rules(); }
}