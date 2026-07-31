<?php

namespace App\Livewire\Admin\RestaurantPOS\OrderItems;

use App\Models\RestaurantPOS\OrderItem;
use App\Domain\RestaurantPOS\OrderItem\DTOs\OrderItemDTO;
use App\Domain\RestaurantPOS\OrderItem\Actions\CreateOrderItemAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

class QuickCreate extends Component
{
        use WithPagination;
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
        if (isset($related->menu_item_id)) { $this->menu_item_id = $related->menu_item_id; }
    }

    public function updatedMenuItemId($value)
    {
        if (!$value) return;
        $related = \App\Models\RestaurantPOS\MenuItem::find($value);
        if (!$related) return;
        if (isset($related->order_id)) { $this->order_id = $related->order_id; }
    }
 
    protected function getordersList() {
        return \App\Models\RestaurantPOS\Order::pluck('id', 'id')->toArray();
    }

    protected function getmenuItemsList() {
        return \App\Models\RestaurantPOS\MenuItem::pluck('name', 'id')->toArray();
    }

    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.restaurant-p-o-s.order-items.quick-create', [
            'orders' => $this->getordersList(),
            'menuItems' => $this->getmenuItemsList(),
        ]); }

    public function store(CreateOrderItemAction $action)
    {
        $this->validate();
        $dto = OrderItemDTO::fromArray([
            'order_id' => $this->order_id,
            'menu_item_id' => $this->menu_item_id,
            'quantity' => $this->quantity,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('order-item-created', id: $item->id);
        $this->js("Livewire.dispatch('order-item-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('restaurant-p-o-s/order-items.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->id ?? $item->id);
        $this->reset(['order_id', 'menu_item_id', 'quantity']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return OrderItem::rules(); }
}