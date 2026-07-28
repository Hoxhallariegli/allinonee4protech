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

class QuickCreate extends Component
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

    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.job-card-services.quick-create', [
            'jobCards' => $this->getjobCardsList(),
            'services' => $this->getservicesList(),
        ]); }

    public function store(CreateJobCardServiceAction $action)
    {
        $this->validate();
        $dto = JobCardServiceDTO::fromArray([
            'job_card_id' => $this->job_card_id,
            'service_id' => $this->service_id,
            'quantity' => $this->quantity,
            'price' => $this->price,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('job-card-service-created', id: $item->id);
        $this->js("Livewire.dispatch('job-card-service-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('job-card-services.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->id ?? $item->id);
        $this->reset(['job_card_id', 'service_id', 'quantity', 'price']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return JobCardService::rules(); }
}