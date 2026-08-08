<?php

namespace App\Livewire\Admin\RestaurantPOS\Ingredients;

use App\Models\RestaurantPOS\Ingredient;
use App\Domain\RestaurantPOS\Ingredient\Queries\IngredientListQuery;
use App\Domain\RestaurantPOS\Ingredient\Actions\DeleteIngredientAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Ingredients')]
class Ingredients extends Component
{
        use WithPagination;

    public int $paginate = 10;
    #[Url(history: true)] public string $search = '';
    public bool $openFilter = false;
    public string $sortField = 'id';
    public bool $sortAsc = true;

    public function resetFilters() { $this->reset(['search', 'openFilter', ]); $this->resetPage(); }

    public function render()
    {
        abort_if_cannot('view_ingredients');
        $query = (new IngredientListQuery())->handle(['search' => $this->search, ], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.restaurant-p-o-s.ingredients.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => Ingredient::sortable(),
        ])->layout('components.layouts.app');
    }

    public function sortBy($field) { if (!in_array($field, Ingredient::sortable(), true)) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deleteIngredient($id, DeleteIngredientAction $action) 
    {
        abort_if_cannot('delete_ingredients');
        $item = Ingredient::find($id);
        if (!$item) { $this->dispatch('toast', message: __('restaurant-p-o-s/ingredients.not_found'), type: 'error'); return; }
        try { $action->execute($item); $this->dispatch('toast', message: __('restaurant-p-o-s/ingredients.deleted'), type: 'success'); $this->resetPage(); } 
        catch (\Illuminate\Database\QueryException $e) { $this->dispatch('toast', message: __('restaurant-p-o-s/ingredients.delete_error_referenced'), type: 'error'); }
        catch (\Exception $e) { $this->dispatch('toast', message: __('restaurant-p-o-s/ingredients.delete_error'), type: 'error'); }
    }
}