<?php

namespace App\Livewire\Admin\WarehouseManagement\StockTransfers;

use App\Models\WarehouseManagement\StockTransfer;
use App\Domain\WarehouseManagement\StockTransfer\DTOs\StockTransferDTO;
use App\Domain\WarehouseManagement\StockTransfer\Actions\UpdateStockTransferAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Edit StockTransfer')]
class Edit extends Component
{
        use WithPagination;
 public StockTransfer $item;
    public $product_id = '';
    public $from_warehouse_id = '';
    public $to_warehouse_id = '';
    public $quantity = '';
 
    #[On('product-created')] 
    public function refreshProducts($id) { $this->product_id = $id; $this->updatedProductId($id); }

    #[On('warehouse-created')] 
    public function refreshFromWarehouses($id) { $this->from_warehouse_id = $id; $this->updatedFromWarehouseId($id); }

    #[On('warehouse-created')] 
    public function refreshToWarehouses($id) { $this->to_warehouse_id = $id; $this->updatedToWarehouseId($id); }
 
    public function updatedProductId($value)
    {
        if (!$value) return;
        $related = \App\Models\WarehouseManagement\Product::find($value);
        if (!$related) return;
        if (isset($related->from_warehouse_id)) { $this->from_warehouse_id = $related->from_warehouse_id; }
        if (isset($related->to_warehouse_id)) { $this->to_warehouse_id = $related->to_warehouse_id; }
    }

    public function updatedFromWarehouseId($value)
    {
        if (!$value) return;
        $related = \App\Models\WarehouseManagement\Warehouse::find($value);
        if (!$related) return;
        if (isset($related->product_id)) { $this->product_id = $related->product_id; }
        if (isset($related->to_warehouse_id)) { $this->to_warehouse_id = $related->to_warehouse_id; }
    }

    public function updatedToWarehouseId($value)
    {
        if (!$value) return;
        $related = \App\Models\WarehouseManagement\Warehouse::find($value);
        if (!$related) return;
        if (isset($related->product_id)) { $this->product_id = $related->product_id; }
        if (isset($related->from_warehouse_id)) { $this->from_warehouse_id = $related->from_warehouse_id; }
    }
 
    protected function getproductsList() {
        return \App\Models\WarehouseManagement\Product::pluck('name', 'id')->toArray();
    }

    protected function getfromWarehousesList() {
        return \App\Models\WarehouseManagement\Warehouse::pluck('name', 'id')->toArray();
    }

    protected function gettoWarehousesList() {
        return \App\Models\WarehouseManagement\Warehouse::pluck('name', 'id')->toArray();
    }

    public function mount(StockTransfer $stockTransfer) { $this->item = $stockTransfer; $this->fill($stockTransfer->toArray());  }
    public function render() { abort_if_cannot('edit_stock_transfers'); return view('livewire.admin.warehouse-management.stock-transfers.edit', [
            'products' => $this->getproductsList(),
            'fromWarehouses' => $this->getfromWarehousesList(),
            'toWarehouses' => $this->gettoWarehousesList(),
        ])->layout('components.layouts.app'); }
    public function update(UpdateStockTransferAction $action) { $this->validate();  $dto = StockTransferDTO::fromArray([
            'product_id' => $this->product_id,
            'from_warehouse_id' => $this->from_warehouse_id,
            'to_warehouse_id' => $this->to_warehouse_id,
            'quantity' => $this->quantity,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('warehouse-management/stock-transfers.updated')); return to_route('admin.warehouse-management.stock-transfers.index'); }
    protected function rules(): array { return StockTransfer::rules($this->item->id); }
}