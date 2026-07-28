<?php

namespace App\Livewire\Admin\PurchaseOrderItems;

use App\Models\PurchaseOrderItem;
use App\Domain\PurchaseOrderItem\DTOs\PurchaseOrderItemDTO;
use App\Domain\PurchaseOrderItem\Actions\UpdatePurchaseOrderItemAction;
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
        $related = \App\Models\PurchaseOrder::find($value);
        if (!$related) return;
        if (isset($related->part_id)) { $this->part_id = $related->part_id; }
    }

    public function updatedPartId($value)
    {
        if (!$value) return;
        $related = \App\Models\Part::find($value);
        if (!$related) return;
        if (isset($related->purchase_order_id)) { $this->purchase_order_id = $related->purchase_order_id; }
    }
 
    protected function getpurchaseOrdersList() {
        return \App\Models\PurchaseOrder::pluck('id', 'id')->toArray();
    }

    protected function getpartsList() {
        return \App\Models\Part::pluck('name', 'id')->toArray();
    }

    public function mount(PurchaseOrderItem $purchaseOrderItem) { $this->item = $purchaseOrderItem; $this->fill($purchaseOrderItem->toArray());  }
    public function render() { abort_if_cannot('edit_purchase_order_items'); return view('livewire.admin.purchase-order-items.edit', [
            'purchaseOrders' => $this->getpurchaseOrdersList(),
            'parts' => $this->getpartsList(),
        ])->layout('components.layouts.app'); }
    public function update(UpdatePurchaseOrderItemAction $action) { $this->validate();  $dto = PurchaseOrderItemDTO::fromArray([
            'purchase_order_id' => $this->purchase_order_id,
            'part_id' => $this->part_id,
            'quantity' => $this->quantity,
            'price' => $this->price,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('purchase-order-items.updated')); return to_route('admin.purchase-order-items.index'); }
    protected function rules(): array { return PurchaseOrderItem::rules($this->item->id); }
}