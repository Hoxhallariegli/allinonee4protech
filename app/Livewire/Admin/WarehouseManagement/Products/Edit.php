<?php

namespace App\Livewire\Admin\WarehouseManagement\Products;

use App\Models\WarehouseManagement\Product;
use App\Domain\WarehouseManagement\Product\DTOs\ProductDTO;
use App\Domain\WarehouseManagement\Product\Actions\UpdateProductAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Edit Product')]
class Edit extends Component
{
        use WithPagination;
 public Product $item;
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

    public function mount(Product $product) { $this->item = $product; $this->fill($product->toArray());  }
    public function render() { abort_if_cannot('edit_products'); return view('livewire.admin.warehouse-management.products.edit', [
            'categories' => $this->getcategoriesList(),
        ])->layout('components.layouts.app'); }
    public function update(UpdateProductAction $action) { $this->validate();  $dto = ProductDTO::fromArray([
            'name' => $this->name,
            'category_id' => $this->category_id,
            'price' => $this->price,
            'stock' => $this->stock,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('warehouse-management/products.updated')); return to_route('admin.warehouse-management.products.index'); }
    protected function rules(): array { return Product::rules($this->item->id); }
}