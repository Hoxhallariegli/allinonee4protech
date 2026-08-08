<?php

namespace App\Livewire\Admin\RestaurantPOS\MenuItems;

use App\Models\RestaurantPOS\MenuItem;
use App\Domain\RestaurantPOS\MenuItem\DTOs\MenuItemDTO;
use App\Domain\RestaurantPOS\MenuItem\Actions\UpdateMenuItemAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;

#[Title('Edit MenuItem')]
class Edit extends Component
{
        use WithPagination, WithFileUploads;
 public MenuItem $item;
    public $name = '';
    public $price = '';
    public $category_id = '';
    public $photo = '';

    public function mount(MenuItem $menuItem) { $this->item = $menuItem; $this->fill($menuItem->toArray());  }
    public function render() {
        abort_if_cannot('edit_menu_items');
        return view('livewire.admin.restaurant-p-o-s.menu-items.edit', [
            'categories' => \App\Models\RestaurantPOS\Category::all(),
        ])->layout('components.layouts.app');
    }
    public function update(UpdateMenuItemAction $action) { $this->validate();         if ($this->photo && !is_string($this->photo)) { $this->photo = $this->photo->store('uploads/menu-items', 'uploads'); }
 $dto = MenuItemDTO::fromArray([
            'name' => $this->name,
            'price' => $this->price,
            'category_id' => $this->category_id,
            'photo' => $this->photo,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('restaurant-p-o-s/menu-items.updated')); return to_route('admin.restaurant-p-o-s.menu-items.index'); }
    protected function rules(): array { return MenuItem::rules($this->item->id); }
}
