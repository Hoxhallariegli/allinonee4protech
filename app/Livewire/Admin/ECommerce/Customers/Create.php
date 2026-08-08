<?php

namespace App\Livewire\Admin\ECommerce\Customers;

use App\Models\ECommerce\Customer;
use App\Domain\ECommerce\Customer\DTOs\CustomerDTO;
use App\Domain\ECommerce\Customer\Actions\CreateCustomerAction;
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
    public $email = '';
    public $phone = '';
   
    public function render() {
        abort_if_cannot('add_customers');
        return view('livewire.admin.e--commerce.customers.create', [
        ])->layout('components.layouts.app');
    }
    public function store(CreateCustomerAction $action) { $this->validate();  $dto = CustomerDTO::fromArray([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
        ]); $action->execute($dto); session()->flash('success', __('e--commerce/customers.created')); return to_route('admin.e--commerce.customers.index'); }
    protected function rules(): array { return Customer::rules(); }
}