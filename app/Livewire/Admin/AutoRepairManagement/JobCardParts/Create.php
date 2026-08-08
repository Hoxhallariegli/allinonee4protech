<?php

namespace App\Livewire\Admin\AutoRepairManagement\JobCardParts;

use App\Models\AutoRepairManagement\JobCardPart;
use App\Domain\AutoRepairManagement\JobCardPart\DTOs\JobCardPartDTO;
use App\Domain\AutoRepairManagement\JobCardPart\Actions\CreateJobCardPartAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Add JobCardPart')]
class Create extends Component
{
        use WithPagination;
     public $job_card_id = '';
    public $part_id = '';
    public $quantity = '';
    public $price = '';
 
    #[On('job-card-created')] 
    public function refreshJobCards($id) { $this->job_card_id = $id; $this->updatedJobCardId($id); }

    #[On('part-created')] 
    public function refreshParts($id) { $this->part_id = $id; $this->updatedPartId($id); }
 
    public function updatedJobCardId($value)
    {
        if (!$value) return;
        $related = \App\Models\AutoRepairManagement\JobCard::find($value);
        if (!$related) return;
    }

    public function updatedPartId($value)
    {
        if (!$value) return;
        $related = \App\Models\AutoRepairManagement\Part::find($value);
        if (!$related) return;
    }
 
    protected function getjobCardsList() {
        return \App\Models\AutoRepairManagement\JobCard::pluck('id', 'id')->toArray();
    }

    protected function getpartsList() {
        return \App\Models\AutoRepairManagement\Part::pluck('name', 'id')->toArray();
    }

    public function render() {
        abort_if_cannot('add_job_card_parts');
        return view('livewire.admin.auto-repair-management.job-card-parts.create', [
            'jobCards' => $this->getjobCardsList(),
            'parts' => $this->getpartsList(),
        ])->layout('components.layouts.app');
    }
    public function store(CreateJobCardPartAction $action) { $this->validate();  $dto = JobCardPartDTO::fromArray([
            'job_card_id' => $this->job_card_id,
            'part_id' => $this->part_id,
            'quantity' => $this->quantity,
            'price' => $this->price,
        ]); $action->execute($dto); session()->flash('success', __('auto-repair-management/job-card-parts.created')); return to_route('admin.auto-repair-management.job-card-parts.index'); }
    protected function rules(): array { return JobCardPart::rules(); }
}