<?php

namespace App\Livewire\Admin\RestaurantPOS\Orders;

use App\Models\RestaurantPOS\Order;
use App\Domain\RestaurantPOS\Order\Queries\OrderListQuery;
use App\Domain\RestaurantPOS\Order\Actions\DeleteOrderAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Orders')]
class Orders extends Component
{
        use WithPagination;

    public int $paginate = 10;
    #[Url(history: true)] public string $search = '';
    #[Url(history: true)] public $table_id = '';
    #[Url(history: true)] public $waiter_id = '';
    public bool $openFilter = false;
    public string $sortField = 'id';
    public bool $sortAsc = true;

    public function resetFilters() { $this->reset(['search', 'openFilter', 'table_id', 'waiter_id', ]); $this->resetPage(); }

    public function render()
    {
        abort_if_cannot('view_orders');
        $query = (new OrderListQuery())->handle(['search' => $this->search,             'table_id' => $this->table_id,
            'waiter_id' => $this->waiter_id,
], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.restaurant-p-o-s.orders.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => Order::sortable(),
            'tables' => \App\Models\RestaurantPOS\DiningTable::pluck('number', 'id')->toArray(),
            'waiters' => \App\Models\RestaurantPOS\Waiter::pluck('name', 'id')->toArray(),
        ])->layout('components.layouts.app');
    }

    public function sortBy($field) { if (!in_array($field, Order::sortable(), true)) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deleteOrder($id, DeleteOrderAction $action) 
    {
        abort_if_cannot('delete_orders');
        $item = Order::find($id);
        if (!$item) { $this->dispatch('toast', message: __('restaurant-p-o-s/orders.not_found'), type: 'error'); return; }
        try { $action->execute($item); $this->dispatch('toast', message: __('restaurant-p-o-s/orders.deleted'), type: 'success'); $this->resetPage(); } 
        catch (\Illuminate\Database\QueryException $e) { $this->dispatch('toast', message: __('restaurant-p-o-s/orders.delete_error_referenced'), type: 'error'); }
        catch (\Exception $e) { $this->dispatch('toast', message: __('restaurant-p-o-s/orders.delete_error'), type: 'error'); }
    }
}