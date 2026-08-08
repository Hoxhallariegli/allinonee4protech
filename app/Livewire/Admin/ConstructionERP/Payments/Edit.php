<?php

namespace App\Livewire\Admin\ConstructionERP\Payments;

use App\Models\ConstructionERP\Payment;
use App\Domain\ConstructionERP\Payment\DTOs\PaymentDTO;
use App\Domain\ConstructionERP\Payment\Actions\UpdatePaymentAction;
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
    public $client_id = '';
    public $amount = '';
    public $payment_date = '';
 
    #[On('client-created')] 
    public function refreshClients($id) { $this->client_id = $id; $this->updatedClientId($id); }
 
    public function updatedClientId($value)
    {
        if (!$value) return;
        $related = \App\Models\ConstructionERP\Client::find($value);
        if (!$related) return;
    }
 
    protected function getclientsList() {
        return \App\Models\ConstructionERP\Client::pluck('name', 'id')->toArray();
    }

    public function mount(Payment $payment) { $this->item = $payment; $this->fill($payment->toArray()); $this->payment_date = $payment->payment_date?->format('Y-m-d'); }
    public function render() {
        abort_if_cannot('edit_payments');
        return view('livewire.admin.construction-e-r-p.payments.edit', [
            'clients' => $this->getclientsList(),
        ])->layout('components.layouts.app');
    }
    public function update(UpdatePaymentAction $action) { $this->validate();  $dto = PaymentDTO::fromArray([
            'client_id' => $this->client_id,
            'amount' => $this->amount,
            'payment_date' => $this->payment_date,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('construction-e-r-p/payments.updated')); return to_route('admin.construction-e-r-p.payments.index'); }
    protected function rules(): array { return Payment::rules($this->item->id); }
}