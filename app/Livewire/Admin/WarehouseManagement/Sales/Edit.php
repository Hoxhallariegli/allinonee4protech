<?php

namespace App\Livewire\Admin\WarehouseManagement\Sales;

use App\Models\WarehouseManagement\Sale;
use App\Domain\WarehouseManagement\Sale\DTOs\SaleDTO;
use App\Domain\WarehouseManagement\Sale\Actions\UpdateSaleAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Edit Sale')]
class Edit extends Component
{
        use WithPagination;
 public Sale $item;
    public $customer_id = '';
    public $sale_date = '';
    public $total = '';
 
    #[On('customer-created')] 
    public function refreshCustomers($id) { $this->customer_id = $id; $this->updatedCustomerId($id); }
 
    public function updatedCustomerId($value)
    {
        if (!$value) return;
        $related = \App\Models\WarehouseManagement\Customer::find($value);
        if (!$related) return;
    }
 
    protected function getcustomersList() {
        return \App\Models\WarehouseManagement\Customer::pluck('name', 'id')->toArray();
    }

    public function mount(Sale $sale) { $this->item = $sale; $this->fill($sale->toArray()); $this->sale_date = $sale->sale_date?->format('Y-m-d'); }
    public function render() {
        abort_if_cannot('edit_sales');
        return view('livewire.admin.warehouse-management.sales.edit', [
            'customers' => $this->getcustomersList(),
        ])->layout('components.layouts.app');
    }
    public function update(UpdateSaleAction $action) { $this->validate();  $dto = SaleDTO::fromArray([
            'customer_id' => $this->customer_id,
            'sale_date' => $this->sale_date,
            'total' => $this->total,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('warehouse-management/sales.updated')); return to_route('admin.warehouse-management.sales.index'); }
    protected function rules(): array { return Sale::rules($this->item->id); }
}