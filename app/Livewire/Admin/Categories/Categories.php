<?php

namespace App\Livewire\Admin\Categories;

use App\Models\Category;
use App\Domain\Category\Queries\CategoryListQuery;
use App\Domain\Category\Actions\DeleteCategoryAction;
use Livewire\{Component, WithPagination, Attributes\Title, Attributes\Url};

#[Title('Categories')]
class Categories extends Component
{
    use WithPagination;
    public int $paginate = 10;
    #[Url(history: true)] public string $search = '';
    public bool $openFilter = false;
    public string $sortField = 'id';
    public bool $sortAsc = true;

    public function updatedSearch() { $this->resetPage(); }
    public function resetFilters() { $this->reset(['search', 'openFilter', ]); }

    public function render()
    {
        abort_if_cannot('view_categories');
        $query = (new CategoryListQuery())->handle([
            'search' => $this->search,

        ], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.categories.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => Category::sortable(),
        ])->layout('components.layouts.app');
    }

    public function sortBy(string $field) { if (!in_array($field, Category::sortable())) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deleteCategory(string $id, DeleteCategoryAction $action) { abort_if_cannot('delete_categories'); $item = Category::findOrFail($id); $action->execute($item); $this->resetPage(); }
}