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

class QuickCreate extends Component
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
        if (isset($related->part_id)) { $this->part_id = $related->part_id; }
    }

    public function updatedPartId($value)
    {
        if (!$value) return;
        $related = \App\Models\AutoRepairManagement\Part::find($value);
        if (!$related) return;
        if (isset($related->job_card_id)) { $this->job_card_id = $related->job_card_id; }
    }
 
    protected function getjobCardsList() {
        return \App\Models\AutoRepairManagement\JobCard::pluck('id', 'id')->toArray();
    }

    protected function getpartsList() {
        return \App\Models\AutoRepairManagement\Part::pluck('name', 'id')->toArray();
    }

    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.auto-repair-management.job-card-parts.quick-create', [
            'jobCards' => $this->getjobCardsList(),
            'parts' => $this->getpartsList(),
        ]); }

    public function store(CreateJobCardPartAction $action)
    {
        $this->validate();
        $dto = JobCardPartDTO::fromArray([
            'job_card_id' => $this->job_card_id,
            'part_id' => $this->part_id,
            'quantity' => $this->quantity,
            'price' => $this->price,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('job-card-part-created', id: $item->id);
        $this->js("Livewire.dispatch('job-card-part-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('auto-repair-management/job-card-parts.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->id ?? $item->id);
        $this->reset(['job_card_id', 'part_id', 'quantity', 'price']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return JobCardPart::rules(); }
}