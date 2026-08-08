<?php

namespace App\Livewire\Admin\WarehouseManagement\Sales;

use App\Models\WarehouseManagement\Sale;
use App\Domain\WarehouseManagement\Sale\DTOs\SaleDTO;
use App\Domain\WarehouseManagement\Sale\Actions\CreateSaleAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Add Sale')]
class Create extends Component
{
        use WithPagination;
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

    public function render() {
        abort_if_cannot('add_sales');
        return view('livewire.admin.warehouse-management.sales.create', [
            'customers' => $this->getcustomersList(),
        ])->layout('components.layouts.app');
    }
    public function store(CreateSaleAction $action) { $this->validate();  $dto = SaleDTO::fromArray([
            'customer_id' => $this->customer_id,
            'sale_date' => $this->sale_date,
            'total' => $this->total,
        ]); $action->execute($dto); session()->flash('success', __('warehouse-management/sales.created')); return to_route('admin.warehouse-management.sales.index'); }
    protected function rules(): array { return Sale::rules(); }
}