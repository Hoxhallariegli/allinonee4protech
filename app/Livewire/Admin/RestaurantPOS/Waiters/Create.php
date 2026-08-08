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
use Livewire\WithFileUploads;

#[Title('Add Waiter')]
class Create extends Component
{
        use WithPagination, WithFileUploads;
     public $name = '';
    public $phone = '';
    public $photo = '';
   
    public function render() {
        abort_if_cannot('add_waiters');
        return view('livewire.admin.restaurant-p-o-s.waiters.create', [
        ])->layout('components.layouts.app');
    }
    public function store(CreateWaiterAction $action) { $this->validate();         if ($this->photo && !is_string($this->photo)) { $this->photo = $this->photo->store('uploads/waiters', 'uploads'); }
 $dto = WaiterDTO::fromArray([
            'name' => $this->name,
            'phone' => $this->phone,
            'photo' => $this->photo,
        ]); $action->execute($dto); session()->flash('success', __('restaurant-p-o-s/waiters.created')); return to_route('admin.restaurant-p-o-s.waiters.index'); }
    protected function rules(): array { return Waiter::rules(); }
}