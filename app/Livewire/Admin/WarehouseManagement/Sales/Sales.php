<?php

namespace App\Livewire\Admin\WarehouseManagement\Sales;

use App\Models\WarehouseManagement\Sale;
use App\Domain\WarehouseManagement\Sale\Queries\SaleListQuery;
use App\Domain\WarehouseManagement\Sale\Actions\DeleteSaleAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Sales')]
class Sales extends Component
{
        use WithPagination;

    public int $paginate = 10;
    #[Url(history: true)] public string $search = '';
    #[Url(history: true)] public $customer_id = '';
    public bool $openFilter = false;
    public string $sortField = 'id';
    public bool $sortAsc = true;

    public function resetFilters() { $this->reset(['search', 'openFilter', 'customer_id', ]); $this->resetPage(); }

    public function render()
    {
        abort_if_cannot('view_sales');
        $query = (new SaleListQuery())->handle(['search' => $this->search,             'customer_id' => $this->customer_id,
], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.warehouse-management.sales.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => Sale::sortable(),
            'customers' => \App\Models\AutoRepairManagement\Customer::pluck('name', 'id')->toArray(),
        ])->layout('components.layouts.app');
    }

    public function sortBy($field) { if (!in_array($field, Sale::sortable(), true)) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deleteSale($id, DeleteSaleAction $action) 
    {
        abort_if_cannot('delete_sales');
        $item = Sale::find($id);
        if (!$item) { $this->dispatch('toast', message: __('warehouse-management/sales.not_found'), type: 'error'); return; }
        try { $action->execute($item); $this->dispatch('toast', message: __('warehouse-management/sales.deleted'), type: 'success'); $this->resetPage(); } 
        catch (\Illuminate\Database\QueryException $e) { $this->dispatch('toast', message: __('warehouse-management/sales.delete_error_referenced'), type: 'error'); }
        catch (\Exception $e) { $this->dispatch('toast', message: __('warehouse-management/sales.delete_error'), type: 'error'); }
    }
}