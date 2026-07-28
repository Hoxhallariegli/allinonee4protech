<?php

namespace App\Livewire\Admin\Estimates;

use App\Models\Estimate;
use App\Domain\Estimate\DTOs\EstimateDTO;
use App\Domain\Estimate\Actions\CreateEstimateAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Add Estimate')]
class Create extends Component
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
        $related = \App\Models\JobCard::find($value);
        if (!$related) return;
    }
 
    protected function getjobCardsList() {
        return \App\Models\JobCard::pluck('id', 'id')->toArray();
    }

    public function render() { abort_if_cannot('add_estimates'); return view('livewire.admin.estimates.create', [
            'jobCards' => $this->getjobCardsList(),
        ])->layout('components.layouts.app'); }
    public function store(CreateEstimateAction $action) { $this->validate();  $dto = EstimateDTO::fromArray([
            'job_card_id' => $this->job_card_id,
            'estimate_date' => $this->estimate_date,
            'status' => $this->status,
        ]); $action->execute($dto); session()->flash('success', __('estimates.created')); return to_route('admin.estimates.index'); }
    protected function rules(): array { return Estimate::rules(); }
}