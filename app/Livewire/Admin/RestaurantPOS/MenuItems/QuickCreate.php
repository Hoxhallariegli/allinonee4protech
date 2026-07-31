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

class QuickCreate extends Component
{
        use WithPagination;
     public $name = '';
    public $price = '';
    public $category = '';
   
    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.restaurant-p-o-s.menu-items.quick-create', [
        ]); }

    public function store(CreateMenuItemAction $action)
    {
        $this->validate();
        $dto = MenuItemDTO::fromArray([
            'name' => $this->name,
            'price' => $this->price,
            'category' => $this->category,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('menu-item-created', id: $item->id);
        $this->js("Livewire.dispatch('menu-item-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('restaurant-p-o-s/menu-items.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->name ?? $item->id);
        $this->reset(['name', 'price', 'category']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return MenuItem::rules(); }
}