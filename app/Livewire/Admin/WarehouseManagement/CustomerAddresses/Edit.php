<?php

namespace App\Livewire\Admin\WarehouseManagement\CustomerAddresses;

use App\Models\WarehouseManagement\CustomerAddress;
use App\Domain\WarehouseManagement\CustomerAddress\DTOs\CustomerAddressDTO;
use App\Domain\WarehouseManagement\CustomerAddress\Actions\UpdateCustomerAddressAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Edit CustomerAddress')]
class Edit extends Component
{
        use WithPagination;
 public CustomerAddress $item;
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

    public function mount(CustomerAddress $customerAddress) { $this->item = $customerAddress; $this->fill($customerAddress->toArray());  }
    public function render() {
        abort_if_cannot('edit_customer_addresses');
        return view('livewire.admin.warehouse-management.customer-addresses.edit', [
            'customers' => $this->getcustomersList(),
        ])->layout('components.layouts.app');
    }
    public function update(UpdateCustomerAddressAction $action) { $this->validate();  $dto = CustomerAddressDTO::fromArray([
            'customer_id' => $this->customer_id,
            'address' => $this->address,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('warehouse-management/customer-addresses.updated')); return to_route('admin.warehouse-management.customer-addresses.index'); }
    protected function rules(): array { return CustomerAddress::rules($this->item->id); }
}