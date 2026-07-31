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

class QuickCreate extends Component
{
        use WithPagination;
     public $name = '';
    public $phone = '';
    public $email = '';
   
    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.warehouse-management.customers.quick-create', [
        ]); }

    public function store(CreateCustomerAction $action)
    {
        $this->validate();
        $dto = CustomerDTO::fromArray([
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('customer-created', id: $item->id);
        $this->js("Livewire.dispatch('customer-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('warehouse-management/customers.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->name ?? $item->id);
        $this->reset(['name', 'phone', 'email']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return Customer::rules(); }
}