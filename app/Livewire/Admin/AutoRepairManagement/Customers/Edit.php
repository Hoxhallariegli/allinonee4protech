<?php

namespace App\Livewire\Admin\AutoRepairManagement\Customers;

use App\Models\AutoRepairManagement\Customer;
use App\Domain\AutoRepairManagement\Customer\DTOs\CustomerDTO;
use App\Domain\AutoRepairManagement\Customer\Actions\UpdateCustomerAction;
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
    public $email = '';
    public $phone = '';
   
    public function mount(Customer $customer) { $this->item = $customer; $this->fill($customer->toArray());  }
    public function render() {
        abort_if_cannot('edit_customers');
        return view('livewire.admin.auto-repair-management.customers.edit', [
        ])->layout('components.layouts.app');
    }
    public function update(UpdateCustomerAction $action) { $this->validate();  $dto = CustomerDTO::fromArray([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('auto-repair-management/customers.updated')); return to_route('admin.auto-repair-management.customers.index'); }
    protected function rules(): array { return Customer::rules($this->item->id); }
}