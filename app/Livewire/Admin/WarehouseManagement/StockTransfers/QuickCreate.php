<?php

namespace App\Livewire\Admin\WarehouseManagement\StockTransfers;

use App\Models\WarehouseManagement\StockTransfer;
use App\Domain\WarehouseManagement\StockTransfer\DTOs\StockTransferDTO;
use App\Domain\WarehouseManagement\StockTransfer\Actions\CreateStockTransferAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

class QuickCreate extends Component
{
        use WithPagination;
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
    }

    public function updatedFromWarehouseId($value)
    {
        if (!$value) return;
        $related = \App\Models\WarehouseManagement\Warehouse::find($value);
        if (!$related) return;
    }

    public function updatedToWarehouseId($value)
    {
        if (!$value) return;
        $related = \App\Models\WarehouseManagement\Warehouse::find($value);
        if (!$related) return;
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

    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.warehouse-management.stock-transfers.quick-create', [
            'products' => $this->getproductsList(),
            'fromWarehouses' => $this->getfromWarehousesList(),
            'toWarehouses' => $this->gettoWarehousesList(),
        ]); }

    public function store(CreateStockTransferAction $action)
    {
        $this->validate();
        $dto = StockTransferDTO::fromArray([
            'product_id' => $this->product_id,
            'from_warehouse_id' => $this->from_warehouse_id,
            'to_warehouse_id' => $this->to_warehouse_id,
            'quantity' => $this->quantity,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('stock-transfer-created', id: $item->id);
        $this->js("Livewire.dispatch('stock-transfer-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('warehouse-management/stock-transfers.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->id ?? $item->id);
        $this->reset(['product_id', 'from_warehouse_id', 'to_warehouse_id', 'quantity']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return StockTransfer::rules(); }
}