<?php

namespace App\Livewire\Admin\AutoRepairManagement\Payments;

use App\Models\AutoRepairManagement\Payment;
use App\Domain\AutoRepairManagement\Payment\DTOs\PaymentDTO;
use App\Domain\AutoRepairManagement\Payment\Actions\UpdatePaymentAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Edit Payment')]
class Edit extends Component
{
        use WithPagination;
 public Payment $item;
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

    public function mount(Payment $payment) { $this->item = $payment; $this->fill($payment->toArray());  }
    public function render() {
        abort_if_cannot('edit_payments');
        return view('livewire.admin.auto-repair-management.payments.edit', [
            'jobCards' => $this->getjobCardsList(),
        ])->layout('components.layouts.app');
    }
    public function update(UpdatePaymentAction $action) { $this->validate();  $dto = PaymentDTO::fromArray([
            'job_card_id' => $this->job_card_id,
            'amount' => $this->amount,
            'status' => $this->status,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('auto-repair-management/payments.updated')); return to_route('admin.auto-repair-management.payments.index'); }
    protected function rules(): array { return Payment::rules($this->item->id); }
}