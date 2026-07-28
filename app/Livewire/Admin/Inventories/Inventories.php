<?php

namespace App\Livewire\Admin\Inventories;

use App\Models\Inventory;
use App\Domain\Inventory\Queries\InventoryListQuery;
use App\Domain\Inventory\Actions\DeleteInventoryAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Inventories')]
class Inventories extends Component
{
        use WithPagination;

    public int $paginate = 10;
    #[Url(history: true)] public string $search = '';
    #[Url(history: true)] public $part_id = '';
    public bool $openFilter = false;
    public string $sortField = 'id';
    public bool $sortAsc = true;

    public function resetFilters() { $this->reset(['search', 'openFilter', 'part_id', ]); $this->resetPage(); }

    public function render()
    {
        abort_if_cannot('view_inventories');
        $query = (new InventoryListQuery())->handle(['search' => $this->search,             'part_id' => $this->part_id,
], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.inventories.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => Inventory::sortable(),
            'parts' => \App\Models\Part::pluck('name', 'id')->toArray(),
        ])->layout('components.layouts.app');
    }

    public function sortBy($field) { if (!in_array($field, Inventory::sortable(), true)) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deleteInventory($id, DeleteInventoryAction $action) 
    {
        abort_if_cannot('delete_inventories');
        $item = Inventory::find($id);
        if (!$item) { $this->dispatch('toast', message: __('inventories.not_found'), type: 'error'); return; }
        try { $action->execute($item); $this->dispatch('toast', message: __('inventories.deleted'), type: 'success'); $this->resetPage(); } 
        catch (\Illuminate\Database\QueryException $e) { $this->dispatch('toast', message: __('inventories.delete_error_referenced'), type: 'error'); }
        catch (\Exception $e) { $this->dispatch('toast', message: __('inventories.delete_error'), type: 'error'); }
    }
}