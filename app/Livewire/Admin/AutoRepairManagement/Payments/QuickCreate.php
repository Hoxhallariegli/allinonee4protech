<?php

namespace App\Livewire\Admin\AutoRepairManagement\Payments;

use App\Models\AutoRepairManagement\Payment;
use App\Domain\AutoRepairManagement\Payment\DTOs\PaymentDTO;
use App\Domain\AutoRepairManagement\Payment\Actions\CreatePaymentAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

class QuickCreate extends Component
{
        use WithPagination;
     public $job_card_id = '';
    public $amount = '';
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

    public function render() { return view('livewire.admin.auto-repair-management.payments.quick-create', [
            'jobCards' => $this->getjobCardsList(),
        ]); }

    public function store(CreatePaymentAction $action)
    {
        $this->validate();
        $dto = PaymentDTO::fromArray([
            'job_card_id' => $this->job_card_id,
            'amount' => $this->amount,
            'status' => $this->status,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('payment-created', id: $item->id);
        $this->js("Livewire.dispatch('payment-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('auto-repair-management/payments.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->id ?? $item->id);
        $this->reset(['job_card_id', 'amount', 'status']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return Payment::rules(); }
}