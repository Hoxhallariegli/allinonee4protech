<?php

namespace App\Livewire\Admin\WarehouseManagement\PurchaseOrders;

use App\Models\WarehouseManagement\PurchaseOrder;
use App\Domain\WarehouseManagement\PurchaseOrder\DTOs\PurchaseOrderDTO;
use App\Domain\WarehouseManagement\PurchaseOrder\Actions\CreatePurchaseOrderAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Add PurchaseOrder')]
class Create extends Component
{
        use WithPagination;
     public $supplier_id = '';
    public $order_date = '';
    public $status = '';
 
    #[On('supplier-created')] 
    public function refreshSuppliers($id) { $this->supplier_id = $id; $this->updatedSupplierId($id); }
 
    public function updatedSupplierId($value)
    {
        if (!$value) return;
        $related = \App\Models\AutoRepairManagement\Supplier::find($value);
        if (!$related) return;
    }
 
    protected function getsuppliersList() {
        return \App\Models\AutoRepairManagement\Supplier::pluck('name', 'id')->toArray();
    }

    public function render() { abort_if_cannot('add_purchase_orders'); return view('livewire.admin.warehouse-management.purchase-orders.create', [
            'suppliers' => $this->getsuppliersList(),
        ])->layout('components.layouts.app'); }
    public function store(CreatePurchaseOrderAction $action) { $this->validate();  $dto = PurchaseOrderDTO::fromArray([
            'supplier_id' => $this->supplier_id,
            'order_date' => $this->order_date,
            'status' => $this->status,
        ]); $action->execute($dto); session()->flash('success', __('warehouse-management/purchase-orders.created')); return to_route('admin.warehouse-management.purchase-orders.index'); }
    protected function rules(): array { return PurchaseOrder::rules(); }
}