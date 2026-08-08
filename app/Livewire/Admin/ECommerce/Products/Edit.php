<?php

namespace App\Livewire\Admin\ECommerce\Products;

use App\Models\ECommerce\Product;
use App\Domain\ECommerce\Product\DTOs\ProductDTO;
use App\Domain\ECommerce\Product\Actions\UpdateProductAction;
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
    public $price = '';
    public $stock = '';
    public $vendor_id = '';
 
    #[On('vendor-created')] 
    public function refreshVendors($id) { $this->vendor_id = $id; $this->updatedVendorId($id); }
 
    public function updatedVendorId($value)
    {
        if (!$value) return;
        $related = \App\Models\ECommerce\Vendor::find($value);
        if (!$related) return;
    }
 
    protected function getvendorsList() {
        return \App\Models\ECommerce\Vendor::pluck('name', 'id')->toArray();
    }

    public function mount(Product $product) { $this->item = $product; $this->fill($product->toArray());  }
    public function render() {
        abort_if_cannot('edit_products');
        return view('livewire.admin.e--commerce.products.edit', [
            'vendors' => $this->getvendorsList(),
        ])->layout('components.layouts.app');
    }
    public function update(UpdateProductAction $action) { $this->validate();  $dto = ProductDTO::fromArray([
            'name' => $this->name,
            'price' => $this->price,
            'stock' => $this->stock,
            'vendor_id' => $this->vendor_id,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('e--commerce/products.updated')); return to_route('admin.e--commerce.products.index'); }
    protected function rules(): array { return Product::rules($this->item->id); }
}