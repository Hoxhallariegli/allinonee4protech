<?php

namespace App\Livewire\Admin\RestaurantPOS\Orders;

use App\Models\RestaurantPOS\Order;
use App\Domain\RestaurantPOS\Order\DTOs\OrderDTO;
use App\Domain\RestaurantPOS\Order\Actions\CreateOrderAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Add Order')]
class Create extends Component
{
        use WithPagination;
     public $table_id = '';
    public $waiter_id = '';
    public $order_date = '';
    public $status = '';
 
    #[On('dining-table-created')] 
    public function refreshTables($id) { $this->table_id = $id; $this->updatedTableId($id); }

    #[On('waiter-created')] 
    public function refreshWaiters($id) { $this->waiter_id = $id; $this->updatedWaiterId($id); }
 
    public function updatedTableId($value)
    {
        if (!$value) return;
        $related = \App\Models\RestaurantPOS\DiningTable::find($value);
        if (!$related) return;
        if (isset($related->waiter_id)) { $this->waiter_id = $related->waiter_id; }
    }

    public function updatedWaiterId($value)
    {
        if (!$value) return;
        $related = \App\Models\RestaurantPOS\Waiter::find($value);
        if (!$related) return;
        if (isset($related->table_id)) { $this->table_id = $related->table_id; }
    }
 
    protected function gettablesList() {
        return \App\Models\RestaurantPOS\DiningTable::pluck('number', 'id')->toArray();
    }

    protected function getwaitersList() {
        return \App\Models\RestaurantPOS\Waiter::pluck('name', 'id')->toArray();
    }

    public function render() { abort_if_cannot('add_orders'); return view('livewire.admin.restaurant-p-o-s.orders.create', [
            'tables' => $this->gettablesList(),
            'waiters' => $this->getwaitersList(),
        ])->layout('components.layouts.app'); }
    public function store(CreateOrderAction $action) { $this->validate();  $dto = OrderDTO::fromArray([
            'table_id' => $this->table_id,
            'waiter_id' => $this->waiter_id,
            'order_date' => $this->order_date,
            'status' => $this->status,
        ]); $action->execute($dto); session()->flash('success', __('restaurant-p-o-s/orders.created')); return to_route('admin.restaurant-p-o-s.orders.index'); }
    protected function rules(): array { return Order::rules(); }
}