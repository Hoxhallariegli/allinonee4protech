<?php

namespace App\Livewire\Admin\ECommerce\OrderItems;

use App\Models\ECommerce\OrderItem;
use App\Domain\ECommerce\OrderItem\DTOs\OrderItemDTO;
use App\Domain\ECommerce\OrderItem\Actions\UpdateOrderItemAction;
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
    public $product_id = '';
    public $quantity = '';
    public $price = '';
 
    #[On('order-created')] 
    public function refreshOrders($id) { $this->order_id = $id; $this->updatedOrderId($id); }

    #[On('product-created')] 
    public function refreshProducts($id) { $this->product_id = $id; $this->updatedProductId($id); }
 
    public function updatedOrderId($value)
    {
        if (!$value) return;
        $related = \App\Models\ECommerce\Order::find($value);
        if (!$related) return;
    }

    public function updatedProductId($value)
    {
        if (!$value) return;
        $related = \App\Models\ECommerce\Product::find($value);
        if (!$related) return;
    }
 
    protected function getordersList() {
        return \App\Models\ECommerce\Order::pluck('id', 'id')->toArray();
    }

    protected function getproductsList() {
        return \App\Models\ECommerce\Product::pluck('name', 'id')->toArray();
    }

    public function mount(OrderItem $orderItem) { $this->item = $orderItem; $this->fill($orderItem->toArray());  }
    public function render() {
        abort_if_cannot('edit_order_items');
        return view('livewire.admin.e--commerce.order-items.edit', [
            'orders' => $this->getordersList(),
            'products' => $this->getproductsList(),
        ])->layout('components.layouts.app');
    }
    public function update(UpdateOrderItemAction $action) { $this->validate();  $dto = OrderItemDTO::fromArray([
            'order_id' => $this->order_id,
            'product_id' => $this->product_id,
            'quantity' => $this->quantity,
            'price' => $this->price,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('e--commerce/order-items.updated')); return to_route('admin.e--commerce.order-items.index'); }
    protected function rules(): array { return OrderItem::rules($this->item->id); }
}