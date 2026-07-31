<?php

namespace App\Livewire\Admin\WarehouseManagement\Products;

use App\Models\WarehouseManagement\Product;
use App\Domain\WarehouseManagement\Product\DTOs\ProductDTO;
use App\Domain\WarehouseManagement\Product\Actions\CreateProductAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

class QuickCreate extends Component
{
        use WithPagination;
     public $name = '';
    public $category_id = '';
    public $price = '';
    public $stock = '';
 
    #[On('category-created')] 
    public function refreshCategories($id) { $this->category_id = $id; $this->updatedCategoryId($id); }
 
    public function updatedCategoryId($value)
    {
        if (!$value) return;
        $related = \App\Models\WarehouseManagement\Category::find($value);
        if (!$related) return;
    }
 
    protected function getcategoriesList() {
        return \App\Models\WarehouseManagement\Category::pluck('name', 'id')->toArray();
    }

    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.warehouse-management.products.quick-create', [
            'categories' => $this->getcategoriesList(),
        ]); }

    public function store(CreateProductAction $action)
    {
        $this->validate();
        $dto = ProductDTO::fromArray([
            'name' => $this->name,
            'category_id' => $this->category_id,
            'price' => $this->price,
            'stock' => $this->stock,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('product-created', id: $item->id);
        $this->js("Livewire.dispatch('product-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('warehouse-management/products.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->name ?? $item->id);
        $this->reset(['name', 'category_id', 'price', 'stock']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return Product::rules(); }
}