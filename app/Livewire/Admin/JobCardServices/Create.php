<?php

namespace App\Livewire\Admin\JobCardServices;

use App\Models\JobCardService;
use App\Domain\JobCardService\DTOs\JobCardServiceDTO;
use App\Domain\JobCardService\Actions\CreateJobCardServiceAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Add JobCardService')]
class Create extends Component
{
        use WithPagination;
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
        $related = \App\Models\JobCard::find($value);
        if (!$related) return;
        if (isset($related->service_id)) { $this->service_id = $related->service_id; }
    }

    public function updatedServiceId($value)
    {
        if (!$value) return;
        $related = \App\Models\Service::find($value);
        if (!$related) return;
        if (isset($related->job_card_id)) { $this->job_card_id = $related->job_card_id; }
    }
 
    protected function getjobCardsList() {
        return \App\Models\JobCard::pluck('id', 'id')->toArray();
    }

    protected function getservicesList() {
        return \App\Models\Service::pluck('name', 'id')->toArray();
    }

    public function render() { abort_if_cannot('add_job_card_services'); return view('livewire.admin.job-card-services.create', [
            'jobCards' => $this->getjobCardsList(),
            'services' => $this->getservicesList(),
        ])->layout('components.layouts.app'); }
    public function store(CreateJobCardServiceAction $action) { $this->validate();  $dto = JobCardServiceDTO::fromArray([
            'job_card_id' => $this->job_card_id,
            'service_id' => $this->service_id,
            'quantity' => $this->quantity,
            'price' => $this->price,
        ]); $action->execute($dto); session()->flash('success', __('job-card-services.created')); return to_route('admin.job-card-services.index'); }
    protected function rules(): array { return JobCardService::rules(); }
}