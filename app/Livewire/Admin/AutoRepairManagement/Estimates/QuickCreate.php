<?php

namespace App\Livewire\Admin\AutoRepairManagement\Estimates;

use App\Models\AutoRepairManagement\Estimate;
use App\Domain\AutoRepairManagement\Estimate\DTOs\EstimateDTO;
use App\Domain\AutoRepairManagement\Estimate\Actions\CreateEstimateAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

class QuickCreate extends Component
{
        use WithPagination;
     public $job_card_id = '';
    public $estimate_date = '';
    public $status = '';
 
    #[On('job-card-created')] 
    public function refreshJobCards($id) { $this->job_card_id = $id; $this->updatedJobCardId($id); }
 
    public function updatedJobCardId($value)
    {
        if (!$value) return;
        $related = \App\Models\AutoRepairManagement\JobCard::find($value);
        if (!$related) return;
    }
 
    protected function getjobCardsList() {
        return \App\Models\AutoRepairManagement\JobCard::pluck('id', 'id')->toArray();
    }

    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.auto-repair-management.estimates.quick-create', [
            'jobCards' => $this->getjobCardsList(),
        ]); }

    public function store(CreateEstimateAction $action)
    {
        $this->validate();
        $dto = EstimateDTO::fromArray([
            'job_card_id' => $this->job_card_id,
            'estimate_date' => $this->estimate_date,
            'status' => $this->status,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('estimate-created', id: $item->id);
        $this->js("Livewire.dispatch('estimate-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('auto-repair-management/estimates.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->id ?? $item->id);
        $this->reset(['job_card_id', 'estimate_date', 'status']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return Estimate::rules(); }
}