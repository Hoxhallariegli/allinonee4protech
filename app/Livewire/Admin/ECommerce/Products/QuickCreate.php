<?php

namespace App\Livewire\Admin\ECommerce\Products;

use App\Models\ECommerce\Product;
use App\Domain\ECommerce\Product\DTOs\ProductDTO;
use App\Domain\ECommerce\Product\Actions\CreateProductAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

class QuickCreate extends Component
{
        use WithPagination;
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

    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.e--commerce.products.quick-create', [
            'vendors' => $this->getvendorsList(),
        ]); }

    public function store(CreateProductAction $action)
    {
        $this->validate();
        $dto = ProductDTO::fromArray([
            'name' => $this->name,
            'price' => $this->price,
            'stock' => $this->stock,
            'vendor_id' => $this->vendor_id,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('product-created', id: $item->id);
        $this->js("Livewire.dispatch('product-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('e--commerce/products.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->name ?? $item->id);
        $this->reset(['name', 'price', 'stock', 'vendor_id']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return Product::rules(); }
}