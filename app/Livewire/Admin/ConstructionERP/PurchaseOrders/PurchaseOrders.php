<?php

namespace App\Livewire\Admin\ConstructionERP\PurchaseOrders;

use App\Models\ConstructionERP\PurchaseOrder;
use App\Domain\ConstructionERP\PurchaseOrder\Queries\PurchaseOrderListQuery;
use App\Domain\ConstructionERP\PurchaseOrder\Actions\DeletePurchaseOrderAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('PurchaseOrders')]
class PurchaseOrders extends Component
{
        use WithPagination;

    public int $paginate = 10;
    #[Url(history: true)] public string $search = '';
    #[Url(history: true)] public $supplier_id = '';
    #[Url(history: true)] public $project_id = '';
    public bool $openFilter = false;
    public string $sortField = 'id';
    public bool $sortAsc = true;

    public function resetFilters() { $this->reset(['search', 'openFilter', 'supplier_id', 'project_id', ]); $this->resetPage(); }

    public function render()
    {
        abort_if_cannot('view_purchase_orders');
        $query = (new PurchaseOrderListQuery())->handle(['search' => $this->search,             'supplier_id' => $this->supplier_id,
            'project_id' => $this->project_id,
], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.construction-e-r-p.purchase-orders.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => PurchaseOrder::sortable(),
            'suppliers' => \App\Models\ConstructionERP\Supplier::pluck('name', 'id')->toArray(),
            'projects' => \App\Models\ConstructionERP\Project::pluck('name', 'id')->toArray(),
        ])->layout('components.layouts.app');
    }

    public function sortBy($field) { if (!in_array($field, PurchaseOrder::sortable(), true)) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deletePurchaseOrder($id, DeletePurchaseOrderAction $action) 
    {
        abort_if_cannot('delete_purchase_orders');
        $item = PurchaseOrder::find($id);
        if (!$item) { $this->dispatch('toast', message: __('construction-e-r-p/purchase-orders.not_found'), type: 'error'); return; }
        try { $action->execute($item); $this->dispatch('toast', message: __('construction-e-r-p/purchase-orders.deleted'), type: 'success'); $this->resetPage(); } 
        catch (\Illuminate\Database\QueryException $e) { $this->dispatch('toast', message: __('construction-e-r-p/purchase-orders.delete_error_referenced'), type: 'error'); }
        catch (\Exception $e) { $this->dispatch('toast', message: __('construction-e-r-p/purchase-orders.delete_error'), type: 'error'); }
    }
}