<?php

namespace App\Livewire\Admin\WarehouseManagement\Customers;

use App\Models\WarehouseManagement\Customer;
use App\Domain\WarehouseManagement\Customer\DTOs\CustomerDTO;
use App\Domain\WarehouseManagement\Customer\Actions\CreateCustomerAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Add Customer')]
class Create extends Component
{
        use WithPagination;
     public $name = '';
    public $phone = '';
    public $email = '';
   
    public function render() { abort_if_cannot('add_customers'); return view('livewire.admin.warehouse-management.customers.create', [
        ])->layout('components.layouts.app'); }
    public function store(CreateCustomerAction $action) { $this->validate();  $dto = CustomerDTO::fromArray([
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
        ]); $action->execute($dto); session()->flash('success', __('warehouse-management/customers.created')); return to_route('admin.warehouse-management.customers.index'); }
    protected function rules(): array { return Customer::rules(); }
}