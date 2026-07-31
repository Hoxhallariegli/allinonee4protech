<?php

namespace App\Livewire\Admin\RestaurantPOS\Waiters;

use App\Models\RestaurantPOS\Waiter;
use App\Domain\RestaurantPOS\Waiter\DTOs\WaiterDTO;
use App\Domain\RestaurantPOS\Waiter\Actions\CreateWaiterAction;
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
   
    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.restaurant-p-o-s.waiters.quick-create', [
        ]); }

    public function store(CreateWaiterAction $action)
    {
        $this->validate();
        $dto = WaiterDTO::fromArray([
            'name' => $this->name,
            'phone' => $this->phone,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('waiter-created', id: $item->id);
        $this->js("Livewire.dispatch('waiter-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('restaurant-p-o-s/waiters.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->name ?? $item->id);
        $this->reset(['name', 'phone']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return Waiter::rules(); }
}