<?php

namespace App\Livewire\Admin\Sales;

use App\Models\Sale;
use App\Domain\Sale\DTOs\SaleDTO;
use App\Domain\Sale\Actions\UpdateSaleAction;
use Illuminate\Support\Str;
use Livewire\{Component, Attributes\Title};

#[Title('Edit Sale')]
class Edit extends Component
{
    public Sale $item;
    public $user_id = '';
    public $new_user_name = '';
    public $product_id = '';
    public $new_product_name = '';
    public $quantity = '';
    public $total_price = '';
    public $sale_date = '';
    public $status = '';
    public $notes = '';
    public $no = '';

    public function mount(Sale $item) { $this->item = $item; $this->fill($item->toArray()); $this->sale_date = $item->sale_date?->format('Y-m-d'); }
    public function render() { abort_if_cannot('edit_sales'); return view('livewire.admin.sales.edit', [
            'users' => \App\Models\User::pluck('name', 'id')->toArray(),
            'products' => \App\Models\Product::pluck('name', 'id')->toArray(),
        ])->layout('components.layouts.app'); }

    public function update(UpdateSaleAction $action)
    {
        $this->validate();
        if ($this->user_id === 'new') { $rel = \App\Models\User::create(['name' => $this->new_user_name, 'slug' => Str::slug($this->new_user_name)]); $this->user_id = $rel->id; }
        if ($this->product_id === 'new') { $rel = \App\Models\Product::create(['name' => $this->new_product_name, 'slug' => Str::slug($this->new_product_name)]); $this->product_id = $rel->id; }

        $dto = SaleDTO::fromArray([
            'user_id' => $this->user_id,
            'product_id' => $this->product_id,
            'quantity' => $this->quantity,
            'total_price' => $this->total_price,
            'sale_date' => $this->sale_date,
            'status' => $this->status,
            'notes' => $this->notes,
            'no' => $this->no,
        ]);
        $action->execute($this->item, $dto);
        flash(__('Sale updated'))->success();
        return to_route('admin.sales.index');
    }
    protected function rules(): array { return Sale::rules($this->item->id); }
}