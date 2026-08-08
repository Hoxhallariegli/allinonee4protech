<?php

namespace App\Livewire\Admin\AgricultureManagement\InventorySupplies;

use App\Models\AgricultureManagement\InventorySupply;
use App\Domain\AgricultureManagement\InventorySupply\Queries\InventorySupplyListQuery;
use App\Domain\AgricultureManagement\InventorySupply\Actions\DeleteInventorySupplyAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('InventorySupplies')]
class InventorySupplies extends Component
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
        abort_if_cannot('view_inventory_supplies');
        $query = (new InventorySupplyListQuery())->handle(['search' => $this->search, ], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.agriculture-management.inventory-supplies.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => InventorySupply::sortable(),
        ])->layout('components.layouts.app');
    }

    public function sortBy($field) { if (!in_array($field, InventorySupply::sortable(), true)) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deleteInventorySupply($id, DeleteInventorySupplyAction $action) 
    {
        abort_if_cannot('delete_inventory_supplies');
        $item = InventorySupply::find($id);
        if (!$item) { $this->dispatch('toast', message: __('agriculture-management/inventory-supplies.not_found'), type: 'error'); return; }
        try { $action->execute($item); $this->dispatch('toast', message: __('agriculture-management/inventory-supplies.deleted'), type: 'success'); $this->resetPage(); } 
        catch (\Illuminate\Database\QueryException $e) { $this->dispatch('toast', message: __('agriculture-management/inventory-supplies.delete_error_referenced'), type: 'error'); }
        catch (\Exception $e) { $this->dispatch('toast', message: __('agriculture-management/inventory-supplies.delete_error'), type: 'error'); }
    }
}