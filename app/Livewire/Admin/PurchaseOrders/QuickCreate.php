<?php

namespace App\Livewire\Admin\PurchaseOrders;

use App\Models\PurchaseOrder;
use App\Domain\PurchaseOrder\DTOs\PurchaseOrderDTO;
use App\Domain\PurchaseOrder\Actions\CreatePurchaseOrderAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

class QuickCreate extends Component
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
        $related = \App\Models\Supplier::find($value);
        if (!$related) return;
    }
 
    protected function getsuppliersList() {
        return \App\Models\Supplier::pluck('name', 'id')->toArray();
    }

    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.purchase-orders.quick-create', [
            'suppliers' => $this->getsuppliersList(),
        ]); }

    public function store(CreatePurchaseOrderAction $action)
    {
        $this->validate();
        $dto = PurchaseOrderDTO::fromArray([
            'supplier_id' => $this->supplier_id,
            'order_date' => $this->order_date,
            'status' => $this->status,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('purchase-order-created', id: $item->id);
        $this->js("Livewire.dispatch('purchase-order-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('purchase-orders.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->id ?? $item->id);
        $this->reset(['supplier_id', 'order_date', 'status']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return PurchaseOrder::rules(); }
}