<?php

namespace App\Livewire\Admin\WarehouseManagement\StockAdjustments;

use App\Models\WarehouseManagement\StockAdjustment;
use App\Domain\WarehouseManagement\StockAdjustment\Queries\StockAdjustmentListQuery;
use App\Domain\WarehouseManagement\StockAdjustment\Actions\DeleteStockAdjustmentAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('StockAdjustments')]
class StockAdjustments extends Component
{
        use WithPagination;

    public int $paginate = 10;
    #[Url(history: true)] public string $search = '';
    #[Url(history: true)] public $product_id = '';
    #[Url(history: true)] public $warehouse_id = '';
    public bool $openFilter = false;
    public string $sortField = 'id';
    public bool $sortAsc = true;

    public function resetFilters() { $this->reset(['search', 'openFilter', 'product_id', 'warehouse_id', ]); $this->resetPage(); }

    public function render()
    {
        abort_if_cannot('view_stock_adjustments');
        $query = (new StockAdjustmentListQuery())->handle(['search' => $this->search,             'product_id' => $this->product_id,
            'warehouse_id' => $this->warehouse_id,
], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.warehouse-management.stock-adjustments.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => StockAdjustment::sortable(),
            'products' => \App\Models\WarehouseManagement\Product::pluck('name', 'id')->toArray(),
            'warehouses' => \App\Models\WarehouseManagement\Warehouse::pluck('name', 'id')->toArray(),
        ]);
    }

    public function sortBy($field) { if (!in_array($field, StockAdjustment::sortable(), true)) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deleteStockAdjustment($id, DeleteStockAdjustmentAction $action) 
    {
        abort_if_cannot('delete_stock_adjustments');
        $item = StockAdjustment::find($id);
        if (!$item) { $this->dispatch('toast', message: __('warehouse-management/stock-adjustments.not_found'), type: 'error'); return; }
        try { $action->execute($item); $this->dispatch('toast', message: __('warehouse-management/stock-adjustments.deleted'), type: 'success'); $this->resetPage(); } 
        catch (\Illuminate\Database\QueryException $e) { $this->dispatch('toast', message: __('warehouse-management/stock-adjustments.delete_error_referenced'), type: 'error'); }
        catch (\Exception $e) { $this->dispatch('toast', message: __('warehouse-management/stock-adjustments.delete_error'), type: 'error'); }
    }
}