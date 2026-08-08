<?php

namespace App\Livewire\Admin\RestaurantPOS\Ingredients;

use App\Models\RestaurantPOS\Ingredient;
use App\Domain\RestaurantPOS\Ingredient\DTOs\IngredientDTO;
use App\Domain\RestaurantPOS\Ingredient\Actions\CreateIngredientAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Add Ingredient')]
class Create extends Component
{
        use WithPagination;
     public $name = '';
    public $stock_quantity = '';
    public $unit = '';
   
    public function render() {
        abort_if_cannot('add_ingredients');
        return view('livewire.admin.restaurant-p-o-s.ingredients.create', [
        ])->layout('components.layouts.app');
    }
    public function store(CreateIngredientAction $action) { $this->validate();  $dto = IngredientDTO::fromArray([
            'name' => $this->name,
            'stock_quantity' => $this->stock_quantity,
            'unit' => $this->unit,
        ]); $action->execute($dto); session()->flash('success', __('restaurant-p-o-s/ingredients.created')); return to_route('admin.restaurant-p-o-s.ingredients.index'); }
    protected function rules(): array { return Ingredient::rules(); }
}