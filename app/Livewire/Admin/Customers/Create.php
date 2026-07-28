<?php

namespace App\Livewire\Admin\Customers;

use App\Models\Customer;
use App\Domain\Customer\DTOs\CustomerDTO;
use App\Domain\Customer\Actions\CreateCustomerAction;
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
   
    public function render() { abort_if_cannot('add_customers'); return view('livewire.admin.customers.create', [
        ])->layout('components.layouts.app'); }
    public function store(CreateCustomerAction $action) { $this->validate();  $dto = CustomerDTO::fromArray([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
        ]); $action->execute($dto); session()->flash('success', __('customers.created')); return to_route('admin.customers.index'); }
    protected function rules(): array { return Customer::rules(); }
}