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

class QuickCreate extends Component
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

    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.e--commerce.orders.quick-create', [
            'customers' => $this->getcustomersList(),
        ]); }

    public function store(CreateOrderAction $action)
    {
        $this->validate();
        $dto = OrderDTO::fromArray([
            'customer_id' => $this->customer_id,
            'total' => $this->total,
            'status' => $this->status,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('order-created', id: $item->id);
        $this->js("Livewire.dispatch('order-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('e--commerce/orders.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->id ?? $item->id);
        $this->reset(['customer_id', 'total', 'status']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return Order::rules(); }
}