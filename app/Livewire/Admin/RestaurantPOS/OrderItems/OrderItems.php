<?php

namespace App\Livewire\Admin\RestaurantPOS\OrderItems;

use App\Models\RestaurantPOS\OrderItem;
use App\Domain\RestaurantPOS\OrderItem\Queries\OrderItemListQuery;
use App\Domain\RestaurantPOS\OrderItem\Actions\DeleteOrderItemAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('OrderItems')]
class OrderItems extends Component
{
        use WithPagination;

    public int $paginate = 10;
    #[Url(history: true)] public string $search = '';
    #[Url(history: true)] public $order_id = '';
    #[Url(history: true)] public $menu_item_id = '';
    public bool $openFilter = false;
    public string $sortField = 'id';
    public bool $sortAsc = true;

    public function resetFilters() { $this->reset(['search', 'openFilter', 'order_id', 'menu_item_id', ]); $this->resetPage(); }

    public function render()
    {
        abort_if_cannot('view_order_items');
        $query = (new OrderItemListQuery())->handle(['search' => $this->search,             'order_id' => $this->order_id,
            'menu_item_id' => $this->menu_item_id,
], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.restaurant-p-o-s.order-items.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => OrderItem::sortable(),
            'orders' => \App\Models\RestaurantPOS\Order::pluck('id', 'id')->toArray(),
            'menuItems' => \App\Models\RestaurantPOS\MenuItem::pluck('name', 'id')->toArray(),
        ])->layout('components.layouts.app');
    }

    public function sortBy($field) { if (!in_array($field, OrderItem::sortable(), true)) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deleteOrderItem($id, DeleteOrderItemAction $action) 
    {
        abort_if_cannot('delete_order_items');
        $item = OrderItem::find($id);
        if (!$item) { $this->dispatch('toast', message: __('restaurant-p-o-s/order-items.not_found'), type: 'error'); return; }
        try { $action->execute($item); $this->dispatch('toast', message: __('restaurant-p-o-s/order-items.deleted'), type: 'success'); $this->resetPage(); } 
        catch (\Illuminate\Database\QueryException $e) { $this->dispatch('toast', message: __('restaurant-p-o-s/order-items.delete_error_referenced'), type: 'error'); }
        catch (\Exception $e) { $this->dispatch('toast', message: __('restaurant-p-o-s/order-items.delete_error'), type: 'error'); }
    }
}