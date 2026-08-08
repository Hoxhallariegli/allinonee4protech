<?php

namespace App\Livewire\Admin\AutoRepairManagement\PurchaseOrderItems;

use App\Models\AutoRepairManagement\PurchaseOrderItem;
use App\Domain\AutoRepairManagement\PurchaseOrderItem\DTOs\PurchaseOrderItemDTO;
use App\Domain\AutoRepairManagement\PurchaseOrderItem\Actions\UpdatePurchaseOrderItemAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Edit PurchaseOrderItem')]
class Edit extends Component
{
        use WithPagination;
 public PurchaseOrderItem $item;
    public $purchase_order_id = '';
    public $part_id = '';
    public $quantity = '';
    public $price = '';
 
    #[On('purchase-order-created')] 
    public function refreshPurchaseOrders($id) { $this->purchase_order_id = $id; $this->updatedPurchaseOrderId($id); }

    #[On('part-created')] 
    public function refreshParts($id) { $this->part_id = $id; $this->updatedPartId($id); }
 
    public function updatedPurchaseOrderId($value)
    {
        if (!$value) return;
        $related = \App\Models\AutoRepairManagement\PurchaseOrder::find($value);
        if (!$related) return;
    }

    public function updatedPartId($value)
    {
        if (!$value) return;
        $related = \App\Models\AutoRepairManagement\Part::find($value);
        if (!$related) return;
    }
 
    protected function getpurchaseOrdersList() {
        return \App\Models\AutoRepairManagement\PurchaseOrder::pluck('id', 'id')->toArray();
    }

    protected function getpartsList() {
        return \App\Models\AutoRepairManagement\Part::pluck('name', 'id')->toArray();
    }

    public function mount(PurchaseOrderItem $purchaseOrderItem) { $this->item = $purchaseOrderItem; $this->fill($purchaseOrderItem->toArray());  }
    public function render() {
        abort_if_cannot('edit_purchase_order_items');
        return view('livewire.admin.auto-repair-management.purchase-order-items.edit', [
            'purchaseOrders' => $this->getpurchaseOrdersList(),
            'parts' => $this->getpartsList(),
        ])->layout('components.layouts.app');
    }
    public function update(UpdatePurchaseOrderItemAction $action) { $this->validate();  $dto = PurchaseOrderItemDTO::fromArray([
            'purchase_order_id' => $this->purchase_order_id,
            'part_id' => $this->part_id,
            'quantity' => $this->quantity,
            'price' => $this->price,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('auto-repair-management/purchase-order-items.updated')); return to_route('admin.auto-repair-management.purchase-order-items.index'); }
    protected function rules(): array { return PurchaseOrderItem::rules($this->item->id); }
}