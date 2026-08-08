<?php

namespace App\Livewire\Admin\RestaurantPOS\Payments;

use App\Models\RestaurantPOS\Payment;
use App\Domain\RestaurantPOS\Payment\DTOs\PaymentDTO;
use App\Domain\RestaurantPOS\Payment\Actions\UpdatePaymentAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Edit Payment')]
class Edit extends Component
{
        use WithPagination;
 public Payment $item;
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

    public function mount(Payment $payment) { $this->item = $payment; $this->fill($payment->toArray());  }
    public function render() {
        abort_if_cannot('edit_payments');
        return view('livewire.admin.restaurant-p-o-s.payments.edit', [
            'orders' => $this->getordersList(),
        ])->layout('components.layouts.app');
    }
    public function update(UpdatePaymentAction $action) { $this->validate();  $dto = PaymentDTO::fromArray([
            'order_id' => $this->order_id,
            'amount' => $this->amount,
            'method' => $this->method,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('restaurant-p-o-s/payments.updated')); return to_route('admin.restaurant-p-o-s.payments.index'); }
    protected function rules(): array { return Payment::rules($this->item->id); }
}