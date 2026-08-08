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

class QuickCreate extends Component
{
        use WithPagination;
     public $name = '';
    public $stock_quantity = '';
    public $unit = '';
   
    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.restaurant-p-o-s.ingredients.quick-create', [
        ]); }

    public function store(CreateIngredientAction $action)
    {
        $this->validate();
        $dto = IngredientDTO::fromArray([
            'name' => $this->name,
            'stock_quantity' => $this->stock_quantity,
            'unit' => $this->unit,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('ingredient-created', id: $item->id);
        $this->js("Livewire.dispatch('ingredient-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('restaurant-p-o-s/ingredients.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->name ?? $item->id);
        $this->reset(['name', 'stock_quantity', 'unit']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return Ingredient::rules(); }
}