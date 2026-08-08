<?php

namespace App\Livewire\Admin\AutoRepairManagement\EstimateItems;

use App\Models\AutoRepairManagement\EstimateItem;
use App\Domain\AutoRepairManagement\EstimateItem\DTOs\EstimateItemDTO;
use App\Domain\AutoRepairManagement\EstimateItem\Actions\CreateEstimateItemAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Add EstimateItem')]
class Create extends Component
{
        use WithPagination;
     public $estimate_id = '';
    public $service_id = '';
    public $part_id = '';
    public $quantity = '';
 
    #[On('estimate-created')] 
    public function refreshEstimates($id) { $this->estimate_id = $id; $this->updatedEstimateId($id); }

    #[On('service-created')] 
    public function refreshServices($id) { $this->service_id = $id; $this->updatedServiceId($id); }

    #[On('part-created')] 
    public function refreshParts($id) { $this->part_id = $id; $this->updatedPartId($id); }
 
    public function updatedEstimateId($value)
    {
        if (!$value) return;
        $related = \App\Models\AutoRepairManagement\Estimate::find($value);
        if (!$related) return;
    }

    public function updatedServiceId($value)
    {
        if (!$value) return;
        $related = \App\Models\AutoRepairManagement\Service::find($value);
        if (!$related) return;
    }

    public function updatedPartId($value)
    {
        if (!$value) return;
        $related = \App\Models\AutoRepairManagement\Part::find($value);
        if (!$related) return;
    }
 
    protected function getestimatesList() {
        return \App\Models\AutoRepairManagement\Estimate::pluck('id', 'id')->toArray();
    }

    protected function getservicesList() {
        return \App\Models\AutoRepairManagement\Service::pluck('name', 'id')->toArray();
    }

    protected function getpartsList() {
        return \App\Models\AutoRepairManagement\Part::pluck('name', 'id')->toArray();
    }

    public function render() {
        abort_if_cannot('add_estimate_items');
        return view('livewire.admin.auto-repair-management.estimate-items.create', [
            'estimates' => $this->getestimatesList(),
            'services' => $this->getservicesList(),
            'parts' => $this->getpartsList(),
        ])->layout('components.layouts.app');
    }
    public function store(CreateEstimateItemAction $action) { $this->validate();  $dto = EstimateItemDTO::fromArray([
            'estimate_id' => $this->estimate_id,
            'service_id' => $this->service_id,
            'part_id' => $this->part_id,
            'quantity' => $this->quantity,
        ]); $action->execute($dto); session()->flash('success', __('auto-repair-management/estimate-items.created')); return to_route('admin.auto-repair-management.estimate-items.index'); }
    protected function rules(): array { return EstimateItem::rules(); }
}