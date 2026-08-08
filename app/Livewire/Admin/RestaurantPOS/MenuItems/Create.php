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
use Livewire\WithFileUploads;

#[Title('Add MenuItem')]
class Create extends Component
{
        use WithPagination, WithFileUploads;
     public $name = '';
    public $price = '';
    public $category_id = '';
    public $photo = '';

    public function render() {
        abort_if_cannot('add_menu_items');
        return view('livewire.admin.restaurant-p-o-s.menu-items.create', [
            'categories' => \App\Models\RestaurantPOS\Category::all(),
        ])->layout('components.layouts.app');
    }
    public function store(CreateMenuItemAction $action) { $this->validate();         if ($this->photo && !is_string($this->photo)) { $this->photo = $this->photo->store('uploads/menu-items', 'uploads'); }
 $dto = MenuItemDTO::fromArray([
            'name' => $this->name,
            'price' => $this->price,
            'category_id' => $this->category_id,
            'photo' => $this->photo,
        ]); $action->execute($dto); session()->flash('success', __('restaurant-p-o-s/menu-items.created')); return to_route('admin.restaurant-p-o-s.menu-items.index'); }
    protected function rules(): array { return MenuItem::rules(); }
}
