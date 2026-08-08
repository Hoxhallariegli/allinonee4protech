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

class QuickCreate extends Component
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

    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.warehouse-management.sales.quick-create', [
            'customers' => $this->getcustomersList(),
        ]); }

    public function store(CreateSaleAction $action)
    {
        $this->validate();
        $dto = SaleDTO::fromArray([
            'customer_id' => $this->customer_id,
            'sale_date' => $this->sale_date,
            'total' => $this->total,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('sale-created', id: $item->id);
        $this->js("Livewire.dispatch('sale-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('warehouse-management/sales.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->id ?? $item->id);
        $this->reset(['customer_id', 'sale_date', 'total']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return Sale::rules(); }
}