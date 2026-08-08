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

class QuickCreate extends Component
{
        use WithPagination;
     public $name = '';
    public $stock_quantity = '';
    public $unit = '';
   
    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.agriculture-management.inventory-supplies.quick-create', [
        ]); }

    public function store(CreateInventorySupplyAction $action)
    {
        $this->validate();
        $dto = InventorySupplyDTO::fromArray([
            'name' => $this->name,
            'stock_quantity' => $this->stock_quantity,
            'unit' => $this->unit,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('inventory-supply-created', id: $item->id);
        $this->js("Livewire.dispatch('inventory-supply-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('agriculture-management/inventory-supplies.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->name ?? $item->id);
        $this->reset(['name', 'stock_quantity', 'unit']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return InventorySupply::rules(); }
}