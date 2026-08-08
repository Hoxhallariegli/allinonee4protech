<?php

namespace App\Livewire\Admin\ECommerce\OrderItems;

use App\Models\ECommerce\OrderItem;
use App\Domain\ECommerce\OrderItem\DTOs\OrderItemDTO;
use App\Domain\ECommerce\OrderItem\Actions\CreateOrderItemAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

class QuickCreate extends Component
{
        use WithPagination;
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

    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.e--commerce.order-items.quick-create', [
            'orders' => $this->getordersList(),
            'products' => $this->getproductsList(),
        ]); }

    public function store(CreateOrderItemAction $action)
    {
        $this->validate();
        $dto = OrderItemDTO::fromArray([
            'order_id' => $this->order_id,
            'product_id' => $this->product_id,
            'quantity' => $this->quantity,
            'price' => $this->price,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('order-item-created', id: $item->id);
        $this->js("Livewire.dispatch('order-item-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('e--commerce/order-items.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->id ?? $item->id);
        $this->reset(['order_id', 'product_id', 'quantity', 'price']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return OrderItem::rules(); }
}