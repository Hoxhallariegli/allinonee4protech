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

#[Title('Add CustomerAddress')]
class Create extends Component
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

    public function render() {
        abort_if_cannot('add_customer_addresses');
        return view('livewire.admin.warehouse-management.customer-addresses.create', [
            'customers' => $this->getcustomersList(),
        ])->layout('components.layouts.app');
    }
    public function store(CreateCustomerAddressAction $action) { $this->validate();  $dto = CustomerAddressDTO::fromArray([
            'customer_id' => $this->customer_id,
            'address' => $this->address,
        ]); $action->execute($dto); session()->flash('success', __('warehouse-management/customer-addresses.created')); return to_route('admin.warehouse-management.customer-addresses.index'); }
    protected function rules(): array { return CustomerAddress::rules(); }
}