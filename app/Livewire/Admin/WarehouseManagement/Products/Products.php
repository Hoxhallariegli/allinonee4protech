<?php

namespace App\Livewire\Admin\WarehouseManagement\Products;

use App\Models\WarehouseManagement\Product;
use App\Domain\WarehouseManagement\Product\Queries\ProductListQuery;
use App\Domain\WarehouseManagement\Product\Actions\DeleteProductAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

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

    public function resetFilters() { $this->reset(['search', 'openFilter', 'category_id', ]); $this->resetPage(); }

    public function render()
    {
        abort_if_cannot('view_products');
        $query = (new ProductListQuery())->handle(['search' => $this->search,             'category_id' => $this->category_id,
], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.warehouse-management.products.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => Product::sortable(),
            'categories' => \App\Models\WarehouseManagement\Category::pluck('name', 'id')->toArray(),
        ])->layout('components.layouts.app');
    }

    public function sortBy($field) { if (!in_array($field, Product::sortable(), true)) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deleteProduct($id, DeleteProductAction $action) 
    {
        abort_if_cannot('delete_products');
        $item = Product::find($id);
        if (!$item) { $this->dispatch('toast', message: __('warehouse-management/products.not_found'), type: 'error'); return; }
        try { $action->execute($item); $this->dispatch('toast', message: __('warehouse-management/products.deleted'), type: 'success'); $this->resetPage(); } 
        catch (\Illuminate\Database\QueryException $e) { $this->dispatch('toast', message: __('warehouse-management/products.delete_error_referenced'), type: 'error'); }
        catch (\Exception $e) { $this->dispatch('toast', message: __('warehouse-management/products.delete_error'), type: 'error'); }
    }
}