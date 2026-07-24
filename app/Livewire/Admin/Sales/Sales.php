<?php

namespace App\Livewire\Admin\Sales;

use App\Models\Sale;
use App\Domain\Sale\Queries\SaleListQuery;
use App\Domain\Sale\Actions\DeleteSaleAction;
use Livewire\{Component, WithPagination, Attributes\Title, Attributes\Url};

#[Title('Sales')]
class Sales extends Component
{
    use WithPagination;
    public int $paginate = 10;
    #[Url(history: true)] public string $search = '';
    #[Url(history: true)] public $user_id = '';
    #[Url(history: true)] public $product_id = '';
    public bool $openFilter = false;
    public string $sortField = 'id';
    public bool $sortAsc = true;

    public function updatedSearch() { $this->resetPage(); }
    public function resetFilters() { $this->reset(['search', 'openFilter', 'user_id', 'product_id', ]); }

    public function render()
    {
        abort_if_cannot('view_sales');
        $query = (new SaleListQuery())->handle([
            'search' => $this->search,
            'user_id' => $this->user_id,
            'product_id' => $this->product_id,
        ], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.sales.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => Sale::sortable(),
            'users' => \App\Models\User::pluck('name', 'id')->toArray(),
            'products' => \App\Models\Product::pluck('name', 'id')->toArray(),
        ])->layout('components.layouts.app');
    }

    public function sortBy(string $field) { if (!in_array($field, Sale::sortable())) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deleteSale(string $id, DeleteSaleAction $action) { abort_if_cannot('delete_sales'); $item = Sale::findOrFail($id); $action->execute($item); $this->resetPage(); }
}