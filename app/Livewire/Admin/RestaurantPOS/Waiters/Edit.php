<?php

namespace App\Livewire\Admin\RestaurantPOS\Waiters;

use App\Models\RestaurantPOS\Waiter;
use App\Domain\RestaurantPOS\Waiter\DTOs\WaiterDTO;
use App\Domain\RestaurantPOS\Waiter\Actions\UpdateWaiterAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Edit Waiter')]
class Edit extends Component
{
        use WithPagination;
 public Waiter $item;
    public $name = '';
    public $phone = '';
   
    public function mount(Waiter $waiter) { $this->item = $waiter; $this->fill($waiter->toArray());  }
    public function render() { abort_if_cannot('edit_waiters'); return view('livewire.admin.restaurant-p-o-s.waiters.edit', [
        ])->layout('components.layouts.app'); }
    public function update(UpdateWaiterAction $action) { $this->validate();  $dto = WaiterDTO::fromArray([
            'name' => $this->name,
            'phone' => $this->phone,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('restaurant-p-o-s/waiters.updated')); return to_route('admin.restaurant-p-o-s.waiters.index'); }
    protected function rules(): array { return Waiter::rules($this->item->id); }
}