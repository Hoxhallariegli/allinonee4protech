<?php

namespace App\Livewire\Admin\WarehouseManagement\StockTransfers;

use App\Models\WarehouseManagement\StockTransfer;
use App\Domain\WarehouseManagement\StockTransfer\Queries\StockTransferListQuery;
use App\Domain\WarehouseManagement\StockTransfer\Actions\DeleteStockTransferAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('StockTransfers')]
class StockTransfers extends Component
{
        use WithPagination;

    public int $paginate = 10;
    #[Url(history: true)] public string $search = '';
    #[Url(history: true)] public $product_id = '';
    #[Url(history: true)] public $from_warehouse_id = '';
    #[Url(history: true)] public $to_warehouse_id = '';
    public bool $openFilter = false;
    public string $sortField = 'id';
    public bool $sortAsc = true;

    public function resetFilters() { $this->reset(['search', 'openFilter', 'product_id', 'from_warehouse_id', 'to_warehouse_id', ]); $this->resetPage(); }

    public function render()
    {
        abort_if_cannot('view_stock_transfers');
        $query = (new StockTransferListQuery())->handle(['search' => $this->search,             'product_id' => $this->product_id,
            'from_warehouse_id' => $this->from_warehouse_id,
            'to_warehouse_id' => $this->to_warehouse_id,
], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.warehouse-management.stock-transfers.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => StockTransfer::sortable(),
            'products' => \App\Models\WarehouseManagement\Product::pluck('name', 'id')->toArray(),
            'fromWarehouses' => \App\Models\WarehouseManagement\Warehouse::pluck('name', 'id')->toArray(),
            'toWarehouses' => \App\Models\WarehouseManagement\Warehouse::pluck('name', 'id')->toArray(),
        ])->layout('components.layouts.app');
    }

    public function sortBy($field) { if (!in_array($field, StockTransfer::sortable(), true)) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deleteStockTransfer($id, DeleteStockTransferAction $action) 
    {
        abort_if_cannot('delete_stock_transfers');
        $item = StockTransfer::find($id);
        if (!$item) { $this->dispatch('toast', message: __('warehouse-management/stock-transfers.not_found'), type: 'error'); return; }
        try { $action->execute($item); $this->dispatch('toast', message: __('warehouse-management/stock-transfers.deleted'), type: 'success'); $this->resetPage(); } 
        catch (\Illuminate\Database\QueryException $e) { $this->dispatch('toast', message: __('warehouse-management/stock-transfers.delete_error_referenced'), type: 'error'); }
        catch (\Exception $e) { $this->dispatch('toast', message: __('warehouse-management/stock-transfers.delete_error'), type: 'error'); }
    }
}