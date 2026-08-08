<?php

namespace App\Livewire\Admin\RestaurantPOS\Orders;

use App\Models\RestaurantPOS\Order;
use App\Domain\RestaurantPOS\Order\DTOs\OrderDTO;
use App\Domain\RestaurantPOS\Order\Actions\UpdateOrderAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Edit Order')]
class Edit extends Component
{
        use WithPagination;
 public Order $item;
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
    }

    public function updatedWaiterId($value)
    {
        if (!$value) return;
        $related = \App\Models\RestaurantPOS\Waiter::find($value);
        if (!$related) return;
    }
 
    protected function gettablesList() {
        return \App\Models\RestaurantPOS\DiningTable::pluck('number', 'id')->toArray();
    }

    protected function getwaitersList() {
        return \App\Models\RestaurantPOS\Waiter::pluck('name', 'id')->toArray();
    }

    public function mount(Order $order) { $this->item = $order; $this->fill($order->toArray()); $this->order_date = $order->order_date?->format('Y-m-d\TH:i'); }
    public function render() {
        abort_if_cannot('edit_orders');
        return view('livewire.admin.restaurant-p-o-s.orders.edit', [
            'tables' => $this->gettablesList(),
            'waiters' => $this->getwaitersList(),
        ])->layout('components.layouts.app');
    }
    public function update(UpdateOrderAction $action) { $this->validate();  $dto = OrderDTO::fromArray([
            'table_id' => $this->table_id,
            'waiter_id' => $this->waiter_id,
            'order_date' => $this->order_date,
            'status' => $this->status,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('restaurant-p-o-s/orders.updated')); return to_route('admin.restaurant-p-o-s.orders.index'); }
    protected function rules(): array { return Order::rules($this->item->id); }
}