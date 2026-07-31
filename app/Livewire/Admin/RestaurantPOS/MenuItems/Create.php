<?php

namespace App\Livewire\Admin\RestaurantPOS\MenuItems;

use App\Models\RestaurantPOS\MenuItem;
use App\Domain\RestaurantPOS\MenuItem\DTOs\MenuItemDTO;
use App\Domain\RestaurantPOS\MenuItem\Actions\CreateMenuItemAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Add MenuItem')]
class Create extends Component
{
        use WithPagination;
     public $name = '';
    public $price = '';
    public $category = '';
   
    public function render() { abort_if_cannot('add_menu_items'); return view('livewire.admin.restaurant-p-o-s.menu-items.create', [
        ])->layout('components.layouts.app'); }
    public function store(CreateMenuItemAction $action) { $this->validate();  $dto = MenuItemDTO::fromArray([
            'name' => $this->name,
            'price' => $this->price,
            'category' => $this->category,
        ]); $action->execute($dto); session()->flash('success', __('restaurant-p-o-s/menu-items.created')); return to_route('admin.restaurant-p-o-s.menu-items.index'); }
    protected function rules(): array { return MenuItem::rules(); }
}