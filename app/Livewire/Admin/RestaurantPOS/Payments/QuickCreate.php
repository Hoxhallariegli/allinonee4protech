<?php

namespace App\Livewire\Admin\RestaurantPOS\Payments;

use App\Models\RestaurantPOS\Payment;
use App\Domain\RestaurantPOS\Payment\DTOs\PaymentDTO;
use App\Domain\RestaurantPOS\Payment\Actions\CreatePaymentAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

class QuickCreate extends Component
{
        use WithPagination;
     public $order_id = '';
    public $amount = '';
    public $method = '';
 
    #[On('order-created')] 
    public function refreshOrders($id) { $this->order_id = $id; $this->updatedOrderId($id); }
 
    public function updatedOrderId($value)
    {
        if (!$value) return;
        $related = \App\Models\RestaurantPOS\Order::find($value);
        if (!$related) return;
    }
 
    protected function getordersList() {
        return \App\Models\RestaurantPOS\Order::pluck('id', 'id')->toArray();
    }

    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.restaurant-p-o-s.payments.quick-create', [
            'orders' => $this->getordersList(),
        ]); }

    public function store(CreatePaymentAction $action)
    {
        $this->validate();
        $dto = PaymentDTO::fromArray([
            'order_id' => $this->order_id,
            'amount' => $this->amount,
            'method' => $this->method,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('payment-created', id: $item->id);
        $this->js("Livewire.dispatch('payment-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('restaurant-p-o-s/payments.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->id ?? $item->id);
        $this->reset(['order_id', 'amount', 'method']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return Payment::rules(); }
}