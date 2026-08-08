<?php

namespace App\Livewire\Admin\ECommerce\Products;

use App\Models\ECommerce\Product;
use App\Domain\ECommerce\Product\Queries\ProductListQuery;
use App\Domain\ECommerce\Product\Actions\DeleteProductAction;
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
    #[Url(history: true)] public $vendor_id = '';
    public bool $openFilter = false;
    public string $sortField = 'id';
    public bool $sortAsc = true;

    public function resetFilters() { $this->reset(['search', 'openFilter', 'vendor_id', ]); $this->resetPage(); }

    public function render()
    {
        abort_if_cannot('view_products');
        $query = (new ProductListQuery())->handle(['search' => $this->search,             'vendor_id' => $this->vendor_id,
], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.e--commerce.products.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => Product::sortable(),
            'vendors' => \App\Models\ECommerce\Vendor::pluck('name', 'id')->toArray(),
        ])->layout('components.layouts.app');
    }

    public function sortBy($field) { if (!in_array($field, Product::sortable(), true)) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deleteProduct($id, DeleteProductAction $action) 
    {
        abort_if_cannot('delete_products');
        $item = Product::find($id);
        if (!$item) { $this->dispatch('toast', message: __('e--commerce/products.not_found'), type: 'error'); return; }
        try { $action->execute($item); $this->dispatch('toast', message: __('e--commerce/products.deleted'), type: 'success'); $this->resetPage(); } 
        catch (\Illuminate\Database\QueryException $e) { $this->dispatch('toast', message: __('e--commerce/products.delete_error_referenced'), type: 'error'); }
        catch (\Exception $e) { $this->dispatch('toast', message: __('e--commerce/products.delete_error'), type: 'error'); }
    }
}