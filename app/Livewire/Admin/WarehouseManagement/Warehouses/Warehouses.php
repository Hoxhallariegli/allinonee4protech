<?php

namespace App\Livewire\Admin\WarehouseManagement\Warehouses;

use App\Models\WarehouseManagement\Warehouse;
use App\Domain\WarehouseManagement\Warehouse\Queries\WarehouseListQuery;
use App\Domain\WarehouseManagement\Warehouse\Actions\DeleteWarehouseAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Warehouses')]
class Warehouses extends Component
{
        use WithPagination;

    public int $paginate = 10;
    #[Url(history: true)] public string $search = '';
    public bool $openFilter = false;
    public string $sortField = 'id';
    public bool $sortAsc = true;

    public function resetFilters() { $this->reset(['search', 'openFilter', ]); $this->resetPage(); }

    public function render()
    {
        abort_if_cannot('view_warehouses');
        $query = (new WarehouseListQuery())->handle(['search' => $this->search, ], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.warehouse-management.warehouses.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => Warehouse::sortable(),
        ])->layout('components.layouts.app');
    }

    public function sortBy($field) { if (!in_array($field, Warehouse::sortable(), true)) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deleteWarehouse($id, DeleteWarehouseAction $action) 
    {
        abort_if_cannot('delete_warehouses');
        $item = Warehouse::find($id);
        if (!$item) { $this->dispatch('toast', message: __('warehouse-management/warehouses.not_found'), type: 'error'); return; }
        try { $action->execute($item); $this->dispatch('toast', message: __('warehouse-management/warehouses.deleted'), type: 'success'); $this->resetPage(); } 
        catch (\Illuminate\Database\QueryException $e) { $this->dispatch('toast', message: __('warehouse-management/warehouses.delete_error_referenced'), type: 'error'); }
        catch (\Exception $e) { $this->dispatch('toast', message: __('warehouse-management/warehouses.delete_error'), type: 'error'); }
    }
}