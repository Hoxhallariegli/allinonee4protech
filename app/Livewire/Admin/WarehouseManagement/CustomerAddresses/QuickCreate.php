<?php

namespace App\Livewire\Admin\WarehouseManagement\CustomerAddresses;

use App\Models\WarehouseManagement\CustomerAddress;
use App\Domain\WarehouseManagement\CustomerAddress\DTOs\CustomerAddressDTO;
use App\Domain\WarehouseManagement\CustomerAddress\Actions\CreateCustomerAddressAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

class QuickCreate extends Component
{
        use WithPagination;
     public $customer_id = '';
    public $address = '';
 
    #[On('customer-created')] 
    public function refreshCustomers($id) { $this->customer_id = $id; $this->updatedCustomerId($id); }
 
    public function updatedCustomerId($value)
    {
        if (!$value) return;
        $related = \App\Models\WarehouseManagement\Customer::find($value);
        if (!$related) return;
    }
 
    protected function getcustomersList() {
        return \App\Models\WarehouseManagement\Customer::pluck('name', 'id')->toArray();
    }

    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.warehouse-management.customer-addresses.quick-create', [
            'customers' => $this->getcustomersList(),
        ]); }

    public function store(CreateCustomerAddressAction $action)
    {
        $this->validate();
        $dto = CustomerAddressDTO::fromArray([
            'customer_id' => $this->customer_id,
            'address' => $this->address,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('customer-address-created', id: $item->id);
        $this->js("Livewire.dispatch('customer-address-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('warehouse-management/customer-addresses.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->id ?? $item->id);
        $this->reset(['customer_id', 'address']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return CustomerAddress::rules(); }
}