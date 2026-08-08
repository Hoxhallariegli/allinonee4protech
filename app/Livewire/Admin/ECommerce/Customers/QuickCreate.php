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

class QuickCreate extends Component
{
        use WithPagination;
     public $name = '';
    public $email = '';
    public $phone = '';
   
    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.e--commerce.customers.quick-create', [
        ]); }

    public function store(CreateCustomerAction $action)
    {
        $this->validate();
        $dto = CustomerDTO::fromArray([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('customer-created', id: $item->id);
        $this->js("Livewire.dispatch('customer-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('e--commerce/customers.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->name ?? $item->id);
        $this->reset(['name', 'email', 'phone']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return Customer::rules(); }
}