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

class QuickCreate extends Component
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
        if (isset($related->service_id)) { $this->service_id = $related->service_id; }
        if (isset($related->part_id)) { $this->part_id = $related->part_id; }
    }

    public function updatedServiceId($value)
    {
        if (!$value) return;
        $related = \App\Models\AutoRepairManagement\Service::find($value);
        if (!$related) return;
        if (isset($related->estimate_id)) { $this->estimate_id = $related->estimate_id; }
        if (isset($related->part_id)) { $this->part_id = $related->part_id; }
    }

    public function updatedPartId($value)
    {
        if (!$value) return;
        $related = \App\Models\AutoRepairManagement\Part::find($value);
        if (!$related) return;
        if (isset($related->estimate_id)) { $this->estimate_id = $related->estimate_id; }
        if (isset($related->service_id)) { $this->service_id = $related->service_id; }
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

    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.auto-repair-management.estimate-items.quick-create', [
            'estimates' => $this->getestimatesList(),
            'services' => $this->getservicesList(),
            'parts' => $this->getpartsList(),
        ]); }

    public function store(CreateEstimateItemAction $action)
    {
        $this->validate();
        $dto = EstimateItemDTO::fromArray([
            'estimate_id' => $this->estimate_id,
            'service_id' => $this->service_id,
            'part_id' => $this->part_id,
            'quantity' => $this->quantity,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('estimate-item-created', id: $item->id);
        $this->js("Livewire.dispatch('estimate-item-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('auto-repair-management/estimate-items.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->id ?? $item->id);
        $this->reset(['estimate_id', 'service_id', 'part_id', 'quantity']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return EstimateItem::rules(); }
}