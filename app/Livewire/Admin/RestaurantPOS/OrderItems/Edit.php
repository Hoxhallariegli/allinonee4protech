<?php

namespace App\Livewire\Admin\RestaurantPOS\OrderItems;

use App\Models\RestaurantPOS\OrderItem;
use App\Domain\RestaurantPOS\OrderItem\DTOs\OrderItemDTO;
use App\Domain\RestaurantPOS\OrderItem\Actions\UpdateOrderItemAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Edit OrderItem')]
class Edit extends Component
{
        use WithPagination;
 public OrderItem $item;
    public $order_id = '';
    public $menu_item_id = '';
    public $quantity = '';
 
    #[On('order-created')] 
    public function refreshOrders($id) { $this->order_id = $id; $this->updatedOrderId($id); }

    #[On('menu-item-created')] 
    public function refreshMenuItems($id) { $this->menu_item_id = $id; $this->updatedMenuItemId($id); }
 
    public function updatedOrderId($value)
    {
        if (!$value) return;
        $related = \App\Models\RestaurantPOS\Order::find($value);
        if (!$related) return;
    }

    public function updatedMenuItemId($value)
    {
        if (!$value) return;
        $related = \App\Models\RestaurantPOS\MenuItem::find($value);
        if (!$related) return;
    }
 
    protected function getordersList() {
        return \App\Models\RestaurantPOS\Order::pluck('id', 'id')->toArray();
    }

    protected function getmenuItemsList() {
        return \App\Models\RestaurantPOS\MenuItem::pluck('name', 'id')->toArray();
    }

    public function mount(OrderItem $orderItem) { $this->item = $orderItem; $this->fill($orderItem->toArray());  }
    public function render() {
        abort_if_cannot('edit_order_items');
        return view('livewire.admin.restaurant-p-o-s.order-items.edit', [
            'orders' => $this->getordersList(),
            'menuItems' => $this->getmenuItemsList(),
        ])->layout('components.layouts.app');
    }
    public function update(UpdateOrderItemAction $action) { $this->validate();  $dto = OrderItemDTO::fromArray([
            'order_id' => $this->order_id,
            'menu_item_id' => $this->menu_item_id,
            'quantity' => $this->quantity,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('restaurant-p-o-s/order-items.updated')); return to_route('admin.restaurant-p-o-s.order-items.index'); }
    protected function rules(): array { return OrderItem::rules($this->item->id); }
}