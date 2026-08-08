<?php

namespace App\Livewire\Admin\AutoRepairManagement\JobCardServices;

use App\Models\AutoRepairManagement\JobCardService;
use App\Domain\AutoRepairManagement\JobCardService\DTOs\JobCardServiceDTO;
use App\Domain\AutoRepairManagement\JobCardService\Actions\UpdateJobCardServiceAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Edit JobCardService')]
class Edit extends Component
{
        use WithPagination;
 public JobCardService $item;
    public $job_card_id = '';
    public $service_id = '';
    public $quantity = '';
    public $price = '';
 
    #[On('job-card-created')] 
    public function refreshJobCards($id) { $this->job_card_id = $id; $this->updatedJobCardId($id); }

    #[On('service-created')] 
    public function refreshServices($id) { $this->service_id = $id; $this->updatedServiceId($id); }
 
    public function updatedJobCardId($value)
    {
        if (!$value) return;
        $related = \App\Models\AutoRepairManagement\JobCard::find($value);
        if (!$related) return;
    }

    public function updatedServiceId($value)
    {
        if (!$value) return;
        $related = \App\Models\AutoRepairManagement\Service::find($value);
        if (!$related) return;
    }
 
    protected function getjobCardsList() {
        return \App\Models\AutoRepairManagement\JobCard::pluck('id', 'id')->toArray();
    }

    protected function getservicesList() {
        return \App\Models\AutoRepairManagement\Service::pluck('name', 'id')->toArray();
    }

    public function mount(JobCardService $jobCardService) { $this->item = $jobCardService; $this->fill($jobCardService->toArray());  }
    public function render() {
        abort_if_cannot('edit_job_card_services');
        return view('livewire.admin.auto-repair-management.job-card-services.edit', [
            'jobCards' => $this->getjobCardsList(),
            'services' => $this->getservicesList(),
        ])->layout('components.layouts.app');
    }
    public function update(UpdateJobCardServiceAction $action) { $this->validate();  $dto = JobCardServiceDTO::fromArray([
            'job_card_id' => $this->job_card_id,
            'service_id' => $this->service_id,
            'quantity' => $this->quantity,
            'price' => $this->price,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('auto-repair-management/job-card-services.updated')); return to_route('admin.auto-repair-management.job-card-services.index'); }
    protected function rules(): array { return JobCardService::rules($this->item->id); }
}