<?php

namespace App\Livewire\Admin\BerberApp\Customers;

use App\Models\BerberApp\Customer;
use Livewire\Component;
use Livewire\Attributes\On;

class QuickCreate extends Component
{
    public $name = '';
    public $phone = '';
    public $email = '';

    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render()
    {
        return view('livewire.admin.berber-app.customers.quick-create');
    }

    public function store()
    {
        $this->validate(Customer::rules());

        $item = Customer::create([
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
        ]);

        $this->dispatch('customer-created', id: $item->id);
        $this->dispatch('toast', message: 'Customer created.', type: 'success');

        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = $item->name;

        $this->reset(['name', 'phone', 'email']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }
}
