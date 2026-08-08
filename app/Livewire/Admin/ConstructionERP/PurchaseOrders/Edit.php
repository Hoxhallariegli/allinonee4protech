<?php

namespace App\Livewire\Admin\ConstructionERP\PurchaseOrders;

use App\Models\ConstructionERP\PurchaseOrder;
use App\Domain\ConstructionERP\PurchaseOrder\DTOs\PurchaseOrderDTO;
use App\Domain\ConstructionERP\PurchaseOrder\Actions\UpdatePurchaseOrderAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Edit PurchaseOrder')]
class Edit extends Component
{
        use WithPagination;
 public PurchaseOrder $item;
    public $supplier_id = '';
    public $project_id = '';
    public $order_date = '';
    public $status = '';
 
    #[On('supplier-created')] 
    public function refreshSuppliers($id) { $this->supplier_id = $id; $this->updatedSupplierId($id); }

    #[On('project-created')] 
    public function refreshProjects($id) { $this->project_id = $id; $this->updatedProjectId($id); }
 
    public function updatedSupplierId($value)
    {
        if (!$value) return;
        $related = \App\Models\ConstructionERP\Supplier::find($value);
        if (!$related) return;
    }

    public function updatedProjectId($value)
    {
        if (!$value) return;
        $related = \App\Models\ConstructionERP\Project::find($value);
        if (!$related) return;
    }
 
    protected function getsuppliersList() {
        return \App\Models\ConstructionERP\Supplier::pluck('name', 'id')->toArray();
    }

    protected function getprojectsList() {
        return \App\Models\ConstructionERP\Project::pluck('name', 'id')->toArray();
    }

    public function mount(PurchaseOrder $purchaseOrder) { $this->item = $purchaseOrder; $this->fill($purchaseOrder->toArray()); $this->order_date = $purchaseOrder->order_date?->format('Y-m-d'); }
    public function render() {
        abort_if_cannot('edit_purchase_orders');
        return view('livewire.admin.construction-e-r-p.purchase-orders.edit', [
            'suppliers' => $this->getsuppliersList(),
            'projects' => $this->getprojectsList(),
        ])->layout('components.layouts.app');
    }
    public function update(UpdatePurchaseOrderAction $action) { $this->validate();  $dto = PurchaseOrderDTO::fromArray([
            'supplier_id' => $this->supplier_id,
            'project_id' => $this->project_id,
            'order_date' => $this->order_date,
            'status' => $this->status,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('construction-e-r-p/purchase-orders.updated')); return to_route('admin.construction-e-r-p.purchase-orders.index'); }
    protected function rules(): array { return PurchaseOrder::rules($this->item->id); }
}