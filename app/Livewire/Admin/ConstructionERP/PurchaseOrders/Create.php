<?php

namespace App\Livewire\Admin\ConstructionERP\PurchaseOrders;

use App\Models\ConstructionERP\PurchaseOrder;
use App\Domain\ConstructionERP\PurchaseOrder\DTOs\PurchaseOrderDTO;
use App\Domain\ConstructionERP\PurchaseOrder\Actions\CreatePurchaseOrderAction;
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
        $related = \App\Models\AutoRepairManagement\Supplier::find($value);
        if (!$related) return;
        if (isset($related->project_id)) { $this->project_id = $related->project_id; }
    }

    public function updatedProjectId($value)
    {
        if (!$value) return;
        $related = \App\Models\ConstructionERP\Project::find($value);
        if (!$related) return;
        if (isset($related->supplier_id)) { $this->supplier_id = $related->supplier_id; }
    }
 
    protected function getsuppliersList() {
        return \App\Models\AutoRepairManagement\Supplier::pluck('name', 'id')->toArray();
    }

    protected function getprojectsList() {
        return \App\Models\ConstructionERP\Project::pluck('name', 'id')->toArray();
    }

    public function render() { abort_if_cannot('add_purchase_orders'); return view('livewire.admin.construction-e-r-p.purchase-orders.create', [
            'suppliers' => $this->getsuppliersList(),
            'projects' => $this->getprojectsList(),
        ])->layout('components.layouts.app'); }
    public function store(CreatePurchaseOrderAction $action) { $this->validate();  $dto = PurchaseOrderDTO::fromArray([
            'supplier_id' => $this->supplier_id,
            'project_id' => $this->project_id,
            'order_date' => $this->order_date,
            'status' => $this->status,
        ]); $action->execute($dto); session()->flash('success', __('construction-e-r-p/purchase-orders.created')); return to_route('admin.construction-e-r-p.purchase-orders.index'); }
    protected function rules(): array { return PurchaseOrder::rules(); }
}