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

#[Title('Add StockAdjustment')]
class Create extends Component
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

    public function render() { abort_if_cannot('add_stock_adjustments'); return view('livewire.admin.warehouse-management.stock-adjustments.create', [
            'products' => $this->getproductsList(),
            'warehouses' => $this->getwarehousesList(),
        ]); }
    public function store(CreateStockAdjustmentAction $action) { $this->validate();  $dto = StockAdjustmentDTO::fromArray([
            'product_id' => $this->product_id,
            'warehouse_id' => $this->warehouse_id,
            'quantity' => $this->quantity,
            'adjustment_type' => $this->adjustment_type,
            'reason' => $this->reason,
        ]); $action->execute($dto); session()->flash('success', __('warehouse-management/stock-adjustments.created')); return to_route('admin.warehouse-management.stock-adjustments.index'); }
    protected function rules(): array { return StockAdjustment::rules(); }
}