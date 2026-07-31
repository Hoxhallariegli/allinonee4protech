<?php

namespace App\Livewire\Admin\AutoRepairManagement\Estimates;

use App\Models\AutoRepairManagement\Estimate;
use App\Domain\AutoRepairManagement\Estimate\DTOs\EstimateDTO;
use App\Domain\AutoRepairManagement\Estimate\Actions\UpdateEstimateAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Edit Estimate')]
class Edit extends Component
{
        use WithPagination;
 public Estimate $item;
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

    public function mount(Estimate $estimate) { $this->item = $estimate; $this->fill($estimate->toArray()); $this->estimate_date = $estimate->estimate_date?->format('Y-m-d'); }
    public function render() { abort_if_cannot('edit_estimates'); return view('livewire.admin.auto-repair-management.estimates.edit', [
            'jobCards' => $this->getjobCardsList(),
        ])->layout('components.layouts.app'); }
    public function update(UpdateEstimateAction $action) { $this->validate();  $dto = EstimateDTO::fromArray([
            'job_card_id' => $this->job_card_id,
            'estimate_date' => $this->estimate_date,
            'status' => $this->status,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('auto-repair-management/estimates.updated')); return to_route('admin.auto-repair-management.estimates.index'); }
    protected function rules(): array { return Estimate::rules($this->item->id); }
}