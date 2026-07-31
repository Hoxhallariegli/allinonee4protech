<?php

namespace App\Livewire\Admin\RestaurantPOS\DiningTables;

use App\Models\RestaurantPOS\DiningTable;
use App\Domain\RestaurantPOS\DiningTable\Queries\DiningTableListQuery;
use App\Domain\RestaurantPOS\DiningTable\Actions\DeleteDiningTableAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('DiningTables')]
class DiningTables extends Component
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
        abort_if_cannot('view_dining_tables');
        $query = (new DiningTableListQuery())->handle(['search' => $this->search, ], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.restaurant-p-o-s.dining-tables.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => DiningTable::sortable(),
        ])->layout('components.layouts.app');
    }

    public function sortBy($field) { if (!in_array($field, DiningTable::sortable(), true)) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deleteDiningTable($id, DeleteDiningTableAction $action) 
    {
        abort_if_cannot('delete_dining_tables');
        $item = DiningTable::find($id);
        if (!$item) { $this->dispatch('toast', message: __('restaurant-p-o-s/dining-tables.not_found'), type: 'error'); return; }
        try { $action->execute($item); $this->dispatch('toast', message: __('restaurant-p-o-s/dining-tables.deleted'), type: 'success'); $this->resetPage(); } 
        catch (\Illuminate\Database\QueryException $e) { $this->dispatch('toast', message: __('restaurant-p-o-s/dining-tables.delete_error_referenced'), type: 'error'); }
        catch (\Exception $e) { $this->dispatch('toast', message: __('restaurant-p-o-s/dining-tables.delete_error'), type: 'error'); }
    }
}