<?php

namespace App\Livewire\Admin\WarehouseManagement\StockAdjustments;

use App\Models\WarehouseManagement\StockAdjustment;
use App\Domain\WarehouseManagement\StockAdjustment\DTOs\StockAdjustmentDTO;
use App\Domain\WarehouseManagement\StockAdjustment\Actions\CreateStockAdjustmentAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

class QuickCreate extends Component
{
        use WithPagination;
     public $product_id = '';
    public $warehouse_id = '';
    public $quantity = '';
    public $adjustment_type = '';
    public $reason = '';
 
    #[On('product-created')] 
    public function refreshProducts($id) { $this->product_id = $id; $this->updatedProductId($id); }

    #[On('warehouse-created')] 
    public function refreshWarehouses($id) { $this->warehouse_id = $id; $this->updatedWarehouseId($id); }
 
    public function updatedProductId($value)
    {
        if (!$value) return;
        $related = \App\Models\WarehouseManagement\Product::find($value);
        if (!$related) return;
    }

    public function updatedWarehouseId($value)
    {
        if (!$value) return;
        $related = \App\Models\WarehouseManagement\Warehouse::find($value);
        if (!$related) return;
    }
 
    protected function getproductsList() {
        return \App\Models\WarehouseManagement\Product::pluck('name', 'id')->toArray();
    }

    protected function getwarehousesList() {
        return \App\Models\WarehouseManagement\Warehouse::pluck('name', 'id')->toArray();
    }

    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.warehouse-management.stock-adjustments.quick-create', [
            'products' => $this->getproductsList(),
            'warehouses' => $this->getwarehousesList(),
        ]); }

    public function store(CreateStockAdjustmentAction $action)
    {
        $this->validate();
        $dto = StockAdjustmentDTO::fromArray([
            'product_id' => $this->product_id,
            'warehouse_id' => $this->warehouse_id,
            'quantity' => $this->quantity,
            'adjustment_type' => $this->adjustment_type,
            'reason' => $this->reason,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('stock-adjustment-created', id: $item->id);
        $this->js("Livewire.dispatch('stock-adjustment-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('warehouse-management/stock-adjustments.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->id ?? $item->id);
        $this->reset(['product_id', 'warehouse_id', 'quantity', 'adjustment_type', 'reason']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return StockAdjustment::rules(); }
}