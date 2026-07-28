<?php

namespace App\Livewire\Admin\PurchaseOrderItems;

use App\Models\PurchaseOrderItem;
use App\Domain\PurchaseOrderItem\Queries\PurchaseOrderItemListQuery;
use App\Domain\PurchaseOrderItem\Actions\DeletePurchaseOrderItemAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('PurchaseOrderItems')]
class PurchaseOrderItems extends Component
{
        use WithPagination;

    public int $paginate = 10;
    #[Url(history: true)] public string $search = '';
    #[Url(history: true)] public $purchase_order_id = '';
    #[Url(history: true)] public $part_id = '';
    public bool $openFilter = false;
    public string $sortField = 'id';
    public bool $sortAsc = true;

    public function resetFilters() { $this->reset(['search', 'openFilter', 'purchase_order_id', 'part_id', ]); $this->resetPage(); }

    public function render()
    {
        abort_if_cannot('view_purchase_order_items');
        $query = (new PurchaseOrderItemListQuery())->handle(['search' => $this->search,             'purchase_order_id' => $this->purchase_order_id,
            'part_id' => $this->part_id,
], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.purchase-order-items.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => PurchaseOrderItem::sortable(),
            'purchaseOrders' => \App\Models\PurchaseOrder::pluck('id', 'id')->toArray(),
            'parts' => \App\Models\Part::pluck('name', 'id')->toArray(),
        ])->layout('components.layouts.app');
    }

    public function sortBy($field) { if (!in_array($field, PurchaseOrderItem::sortable(), true)) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deletePurchaseOrderItem($id, DeletePurchaseOrderItemAction $action) 
    {
        abort_if_cannot('delete_purchase_order_items');
        $item = PurchaseOrderItem::find($id);
        if (!$item) { $this->dispatch('toast', message: __('purchase-order-items.not_found'), type: 'error'); return; }
        try { $action->execute($item); $this->dispatch('toast', message: __('purchase-order-items.deleted'), type: 'success'); $this->resetPage(); } 
        catch (\Illuminate\Database\QueryException $e) { $this->dispatch('toast', message: __('purchase-order-items.delete_error_referenced'), type: 'error'); }
        catch (\Exception $e) { $this->dispatch('toast', message: __('purchase-order-items.delete_error'), type: 'error'); }
    }
}