<?php

namespace App\Livewire\Admin\RestaurantPOS\Categories;

use App\Models\RestaurantPOS\Category;
use App\Domain\RestaurantPOS\Category\Queries\CategoryListQuery;
use App\Domain\RestaurantPOS\Category\Actions\DeleteCategoryAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;

#[Title('Categories')]
class Categories extends Component
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
        abort_if_cannot('view_categories');
        $query = (new CategoryListQuery())->handle(['search' => $this->search, ], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.restaurant-p-o-s.categories.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => Category::sortable(),
        ])->layout('components.layouts.app');
    }

    public function sortBy($field) { if (!in_array($field, Category::sortable(), true)) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deleteCategory($id, DeleteCategoryAction $action) 
    {
        abort_if_cannot('delete_categories');
        $item = Category::find($id);
        if (!$item) { $this->dispatch('toast', message: __('restaurant-p-o-s/categories.not_found'), type: 'error'); return; }
        try { $action->execute($item); $this->dispatch('toast', message: __('restaurant-p-o-s/categories.deleted'), type: 'success'); $this->resetPage(); } 
        catch (\Illuminate\Database\QueryException $e) { $this->dispatch('toast', message: __('restaurant-p-o-s/categories.delete_error_referenced'), type: 'error'); }
        catch (\Exception $e) { $this->dispatch('toast', message: __('restaurant-p-o-s/categories.delete_error'), type: 'error'); }
    }
}