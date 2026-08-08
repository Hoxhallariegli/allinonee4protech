<?php

namespace App\Livewire\Admin\WarehouseManagement\StockAdjustments;

use App\Models\WarehouseManagement\StockAdjustment;
use App\Domain\WarehouseManagement\StockAdjustment\DTOs\StockAdjustmentDTO;
use App\Domain\WarehouseManagement\StockAdjustment\Actions\UpdateStockAdjustmentAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Edit StockAdjustment')]
class Edit extends Component
{
        use WithPagination;
 public StockAdjustment $item;
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

    public function mount(StockAdjustment $stockAdjustment) { $this->item = $stockAdjustment; $this->fill($stockAdjustment->toArray());  }
    public function render() { abort_if_cannot('edit_stock_adjustments'); return view('livewire.admin.warehouse-management.stock-adjustments.edit', [
            'products' => $this->getproductsList(),
            'warehouses' => $this->getwarehousesList(),
        ]); }
    public function update(UpdateStockAdjustmentAction $action) { $this->validate();  $dto = StockAdjustmentDTO::fromArray([
            'product_id' => $this->product_id,
            'warehouse_id' => $this->warehouse_id,
            'quantity' => $this->quantity,
            'adjustment_type' => $this->adjustment_type,
            'reason' => $this->reason,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('warehouse-management/stock-adjustments.updated')); return to_route('admin.warehouse-management.stock-adjustments.index'); }
    protected function rules(): array { return StockAdjustment::rules($this->item->id); }
}