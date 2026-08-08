<?php

namespace App\Livewire\Admin\ECommerce\Orders;

use App\Models\ECommerce\Order;
use App\Domain\ECommerce\Order\DTOs\OrderDTO;
use App\Domain\ECommerce\Order\Actions\CreateOrderAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Add Order')]
class Create extends Component
{
        use WithPagination;
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

    public function render() {
        abort_if_cannot('add_orders');
        return view('livewire.admin.e--commerce.orders.create', [
            'customers' => $this->getcustomersList(),
        ])->layout('components.layouts.app');
    }
    public function store(CreateOrderAction $action) { $this->validate();  $dto = OrderDTO::fromArray([
            'customer_id' => $this->customer_id,
            'total' => $this->total,
            'status' => $this->status,
        ]); $action->execute($dto); session()->flash('success', __('e--commerce/orders.created')); return to_route('admin.e--commerce.orders.index'); }
    protected function rules(): array { return Order::rules(); }
}