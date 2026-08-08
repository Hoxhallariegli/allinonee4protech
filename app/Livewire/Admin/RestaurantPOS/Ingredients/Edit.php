<?php

namespace App\Livewire\Admin\RestaurantPOS\Ingredients;

use App\Models\RestaurantPOS\Ingredient;
use App\Domain\RestaurantPOS\Ingredient\DTOs\IngredientDTO;
use App\Domain\RestaurantPOS\Ingredient\Actions\UpdateIngredientAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Edit Ingredient')]
class Edit extends Component
{
        use WithPagination;
 public Ingredient $item;
    public $name = '';
    public $stock_quantity = '';
    public $unit = '';
   
    public function mount(Ingredient $ingredient) { $this->item = $ingredient; $this->fill($ingredient->toArray());  }
    public function render() {
        abort_if_cannot('edit_ingredients');
        return view('livewire.admin.restaurant-p-o-s.ingredients.edit', [
        ])->layout('components.layouts.app');
    }
    public function update(UpdateIngredientAction $action) { $this->validate();  $dto = IngredientDTO::fromArray([
            'name' => $this->name,
            'stock_quantity' => $this->stock_quantity,
            'unit' => $this->unit,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('restaurant-p-o-s/ingredients.updated')); return to_route('admin.restaurant-p-o-s.ingredients.index'); }
    protected function rules(): array { return Ingredient::rules($this->item->id); }
}