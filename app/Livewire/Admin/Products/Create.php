<?php

namespace App\Livewire\Admin\Products;

use App\Models\Product;
use App\Domain\Product\DTOs\ProductDTO;
use App\Domain\Product\Actions\CreateProductAction;
use Illuminate\Support\Str;
use Livewire\{Component, Attributes\Title};

#[Title('Add Product')]
class Create extends Component
{
    public $name = '';
    public $category_id = '';
    public $new_category_name = '';
    public $price = '';
    public $quantity = '';
    public $no = '';

    public function render() { abort_if_cannot('add_products'); return view('livewire.admin.products.create', [
            'categories' => \App\Models\Category::pluck('name', 'id')->toArray(),
        ])->layout('components.layouts.app'); }

    public function store(CreateProductAction $action)
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
        $action->execute($dto);
        flash(__('Product created'))->success();
        return to_route('admin.products.index');
    }
    protected function rules(): array { return Product::rules(); }
}