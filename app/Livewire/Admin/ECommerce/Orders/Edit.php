<?php

namespace App\Livewire\Admin\ECommerce\Orders;

use App\Models\ECommerce\Order;
use App\Domain\ECommerce\Order\DTOs\OrderDTO;
use App\Domain\ECommerce\Order\Actions\UpdateOrderAction;
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
    public $customer_id = '';
    public $total = '';
    public $status = '';
 
    #[On('customer-created')] 
    public function refreshCustomers($id) { $this->customer_id = $id; $this->updatedCustomerId($id); }
 
    public function updatedCustomerId($value)
    {
        if (!$value) return;
        $related = \App\Models\ECommerce\Customer::find($value);
        if (!$related) return;
    }
 
    protected function getcustomersList() {
        return \App\Models\ECommerce\Customer::pluck('name', 'id')->toArray();
    }

    public function mount(Order $order) { $this->item = $order; $this->fill($order->toArray());  }
    public function render() {
        abort_if_cannot('edit_orders');
        return view('livewire.admin.e--commerce.orders.edit', [
            'customers' => $this->getcustomersList(),
        ])->layout('components.layouts.app');
    }
    public function update(UpdateOrderAction $action) { $this->validate();  $dto = OrderDTO::fromArray([
            'customer_id' => $this->customer_id,
            'total' => $this->total,
            'status' => $this->status,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('e--commerce/orders.updated')); return to_route('admin.e--commerce.orders.index'); }
    protected function rules(): array { return Order::rules($this->item->id); }
}