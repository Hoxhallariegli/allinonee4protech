<?php

namespace App\Livewire\Admin\RestaurantPOS\MenuItems;

use App\Models\RestaurantPOS\MenuItem;
use App\Domain\RestaurantPOS\MenuItem\Queries\MenuItemListQuery;
use App\Domain\RestaurantPOS\MenuItem\Actions\DeleteMenuItemAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;

#[Title('MenuItems')]
class MenuItems extends Component
{
        use WithPagination, WithFileUploads;

    public int $paginate = 10;
    #[Url(history: true)] public string $search = '';
    public bool $openFilter = false;
    public string $sortField = 'id';
    public bool $sortAsc = true;

    public function resetFilters() { $this->reset(['search', 'openFilter', ]); $this->resetPage(); }

    public function render()
    {
        abort_if_cannot('view_menu_items');
        $query = (new MenuItemListQuery())->handle(['search' => $this->search, ], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.restaurant-p-o-s.menu-items.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => MenuItem::sortable(),
        ])->layout('components.layouts.app');
    }

    public function sortBy($field) { if (!in_array($field, MenuItem::sortable(), true)) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deleteMenuItem($id, DeleteMenuItemAction $action) 
    {
        abort_if_cannot('delete_menu_items');
        $item = MenuItem::find($id);
        if (!$item) { $this->dispatch('toast', message: __('restaurant-p-o-s/menu-items.not_found'), type: 'error'); return; }
        try { $action->execute($item); $this->dispatch('toast', message: __('restaurant-p-o-s/menu-items.deleted'), type: 'success'); $this->resetPage(); } 
        catch (\Illuminate\Database\QueryException $e) { $this->dispatch('toast', message: __('restaurant-p-o-s/menu-items.delete_error_referenced'), type: 'error'); }
        catch (\Exception $e) { $this->dispatch('toast', message: __('restaurant-p-o-s/menu-items.delete_error'), type: 'error'); }
    }
}