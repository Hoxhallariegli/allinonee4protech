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

#[Title('Add Waiter')]
class Create extends Component
{
        use WithPagination;
     public $name = '';
    public $phone = '';
   
    public function render() { abort_if_cannot('add_waiters'); return view('livewire.admin.restaurant-p-o-s.waiters.create', [
        ])->layout('components.layouts.app'); }
    public function store(CreateWaiterAction $action) { $this->validate();  $dto = WaiterDTO::fromArray([
            'name' => $this->name,
            'phone' => $this->phone,
        ]); $action->execute($dto); session()->flash('success', __('restaurant-p-o-s/waiters.created')); return to_route('admin.restaurant-p-o-s.waiters.index'); }
    protected function rules(): array { return Waiter::rules(); }
}