<?php

namespace App\Livewire\Admin\RestaurantPOS\Recipes;

use App\Models\RestaurantPOS\Recipe;
use App\Domain\RestaurantPOS\Recipe\Queries\RecipeListQuery;
use App\Domain\RestaurantPOS\Recipe\Actions\DeleteRecipeAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Recipes')]
class Recipes extends Component
{
        use WithPagination;

    public int $paginate = 10;
    #[Url(history: true)] public string $search = '';
    #[Url(history: true)] public $menu_item_id = '';
    #[Url(history: true)] public $ingredient_id = '';
    public bool $openFilter = false;
    public string $sortField = 'id';
    public bool $sortAsc = true;

    public function resetFilters() { $this->reset(['search', 'openFilter', 'menu_item_id', 'ingredient_id', ]); $this->resetPage(); }

    public function render()
    {
        abort_if_cannot('view_recipes');
        $query = (new RecipeListQuery())->handle(['search' => $this->search,             'menu_item_id' => $this->menu_item_id,
            'ingredient_id' => $this->ingredient_id,
], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.restaurant-p-o-s.recipes.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => Recipe::sortable(),
            'menuItems' => \App\Models\RestaurantPOS\MenuItem::pluck('name', 'id')->toArray(),
            'ingredients' => \App\Models\RestaurantPOS\Ingredient::pluck('name', 'id')->toArray(),
        ])->layout('components.layouts.app');
    }

    public function sortBy($field) { if (!in_array($field, Recipe::sortable(), true)) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deleteRecipe($id, DeleteRecipeAction $action) 
    {
        abort_if_cannot('delete_recipes');
        $item = Recipe::find($id);
        if (!$item) { $this->dispatch('toast', message: __('restaurant-p-o-s/recipes.not_found'), type: 'error'); return; }
        try { $action->execute($item); $this->dispatch('toast', message: __('restaurant-p-o-s/recipes.deleted'), type: 'success'); $this->resetPage(); } 
        catch (\Illuminate\Database\QueryException $e) { $this->dispatch('toast', message: __('restaurant-p-o-s/recipes.delete_error_referenced'), type: 'error'); }
        catch (\Exception $e) { $this->dispatch('toast', message: __('restaurant-p-o-s/recipes.delete_error'), type: 'error'); }
    }
}