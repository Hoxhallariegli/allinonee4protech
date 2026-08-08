<?php

namespace App\Livewire\Admin\RestaurantPOS\Recipes;

use App\Models\RestaurantPOS\Recipe;
use App\Domain\RestaurantPOS\Recipe\DTOs\RecipeDTO;
use App\Domain\RestaurantPOS\Recipe\Actions\CreateRecipeAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

class QuickCreate extends Component
{
        use WithPagination;
     public $menu_item_id = '';
    public $ingredient_id = '';
    public $quantity_required = '';
 
    #[On('menu-item-created')] 
    public function refreshMenuItems($id) { $this->menu_item_id = $id; $this->updatedMenuItemId($id); }

    #[On('ingredient-created')] 
    public function refreshIngredients($id) { $this->ingredient_id = $id; $this->updatedIngredientId($id); }
 
    public function updatedMenuItemId($value)
    {
        if (!$value) return;
        $related = \App\Models\RestaurantPOS\MenuItem::find($value);
        if (!$related) return;
    }

    public function updatedIngredientId($value)
    {
        if (!$value) return;
        $related = \App\Models\RestaurantPOS\Ingredient::find($value);
        if (!$related) return;
    }
 
    protected function getmenuItemsList() {
        return \App\Models\RestaurantPOS\MenuItem::pluck('name', 'id')->toArray();
    }

    protected function getingredientsList() {
        return \App\Models\RestaurantPOS\Ingredient::pluck('name', 'id')->toArray();
    }

    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.restaurant-p-o-s.recipes.quick-create', [
            'menuItems' => $this->getmenuItemsList(),
            'ingredients' => $this->getingredientsList(),
        ]); }

    public function store(CreateRecipeAction $action)
    {
        $this->validate();
        $dto = RecipeDTO::fromArray([
            'menu_item_id' => $this->menu_item_id,
            'ingredient_id' => $this->ingredient_id,
            'quantity_required' => $this->quantity_required,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('recipe-created', id: $item->id);
        $this->js("Livewire.dispatch('recipe-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('restaurant-p-o-s/recipes.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->id ?? $item->id);
        $this->reset(['menu_item_id', 'ingredient_id', 'quantity_required']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return Recipe::rules(); }
}