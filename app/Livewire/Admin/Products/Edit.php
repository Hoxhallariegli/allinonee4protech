<?php

namespace App\Livewire\Admin\Products;

use App\Models\Product;
use App\Domain\Product\DTOs\ProductDTO;
use App\Domain\Product\Actions\UpdateProductAction;
use Illuminate\Support\Str;
use Livewire\{Component, Attributes\Title};

#[Title('Edit Product')]
class Edit extends Component
{
    public Product $item;
    public $name = '';
    public $category_id = '';
    public $new_category_name = '';
    public $price = '';
    public $quantity = '';
    public $no = '';

    public function mount(Product $item) { $this->item = $item; $this->fill($item->toArray());  }
    public function render() { abort_if_cannot('edit_products'); return view('livewire.admin.products.edit', [
            'categories' => \App\Models\Category::pluck('name', 'id')->toArray(),
        ])->layout('components.layouts.app'); }

    public function update(UpdateProductAction $action)
    {
        $this->validate();
        if ($this->category_id === 'new') { $rel = \App\Models\Category::create(['name' => $this->new_category_name, 'slug' => Str::slug($this->new_category_name)]); $this->category_id = $rel->id; }

        $dto = ProductDTO::fromArray([
            'name' => $this->name,
            'category_id' => $this->category_id,
            'price' => $this->price,
            'quantity' => $this->quantity,
            'no' => $this->no,
        ]);
        $action->execute($this->item, $dto);
        flash(__('Product updated'))->success();
        return to_route('admin.products.index');
    }
    protected function rules(): array { return Product::rules($this->item->id); }
}