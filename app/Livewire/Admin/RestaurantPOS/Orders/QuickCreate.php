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

class QuickCreate extends Component
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

    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.restaurant-p-o-s.orders.quick-create', [
            'tables' => $this->gettablesList(),
            'waiters' => $this->getwaitersList(),
        ]); }

    public function store(CreateOrderAction $action)
    {
        $this->validate();
        $dto = OrderDTO::fromArray([
            'table_id' => $this->table_id,
            'waiter_id' => $this->waiter_id,
            'order_date' => $this->order_date,
            'status' => $this->status,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('order-created', id: $item->id);
        $this->js("Livewire.dispatch('order-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('restaurant-p-o-s/orders.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->id ?? $item->id);
        $this->reset(['table_id', 'waiter_id', 'order_date', 'status']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return Order::rules(); }
}