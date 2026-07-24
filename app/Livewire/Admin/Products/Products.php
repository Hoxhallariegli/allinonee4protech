<?php

namespace App\Livewire\Admin\Products;

use App\Models\Product;
use App\Domain\Product\Queries\ProductListQuery;
use App\Domain\Product\Actions\DeleteProductAction;
use Livewire\{Component, WithPagination, Attributes\Title, Attributes\Url};

#[Title('Products')]
class Products extends Component
{
    use WithPagination;
    public int $paginate = 10;
    #[Url(history: true)] public string $search = '';
    #[Url(history: true)] public $category_id = '';
    public bool $openFilter = false;
    public string $sortField = 'id';
    public bool $sortAsc = true;

    public function updatedSearch() { $this->resetPage(); }
    public function resetFilters() { $this->reset(['search', 'openFilter', 'category_id', ]); }

    public function render()
    {
        abort_if_cannot('view_products');
        $query = (new ProductListQuery())->handle([
            'search' => $this->search,
            'category_id' => $this->category_id,
        ], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.products.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => Product::sortable(),
            'categories' => \App\Models\Category::pluck('name', 'id')->toArray(),
        ])->layout('components.layouts.app');
    }

    public function sortBy(string $field) { if (!in_array($field, Product::sortable())) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deleteProduct(string $id, DeleteProductAction $action) { abort_if_cannot('delete_products'); $item = Product::findOrFail($id); $action->execute($item); $this->resetPage(); }
}