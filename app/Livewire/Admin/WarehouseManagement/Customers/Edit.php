<?php

namespace App\Livewire\Admin\WarehouseManagement\Customers;

use App\Models\WarehouseManagement\Customer;
use App\Domain\WarehouseManagement\Customer\DTOs\CustomerDTO;
use App\Domain\WarehouseManagement\Customer\Actions\UpdateCustomerAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Edit Customer')]
class Edit extends Component
{
        use WithPagination;
 public Customer $item;
    public $name = '';
    public $phone = '';
    public $email = '';
   
    public function mount(Customer $customer) { $this->item = $customer; $this->fill($customer->toArray());  }
    public function render() {
        abort_if_cannot('edit_customers');
        return view('livewire.admin.warehouse-management.customers.edit', [
        ])->layout('components.layouts.app');
    }
    public function update(UpdateCustomerAction $action) { $this->validate();  $dto = CustomerDTO::fromArray([
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('warehouse-management/customers.updated')); return to_route('admin.warehouse-management.customers.index'); }
    protected function rules(): array { return Customer::rules($this->item->id); }
}