<?php

namespace App\Livewire\Admin\ClinicManagement\Payments;

use App\Models\ClinicManagement\Payment;
use App\Domain\ClinicManagement\Payment\DTOs\PaymentDTO;
use App\Domain\ClinicManagement\Payment\Actions\UpdatePaymentAction;
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
    public $patient_id = '';
    public $invoice_id = '';
    public $amount = '';
    public $payment_method = '';
 
    #[On('patient-created')] 
    public function refreshPatients($id) { $this->patient_id = $id; $this->updatedPatientId($id); }

    #[On('clinic-invoice-created')] 
    public function refreshInvoices($id) { $this->invoice_id = $id; $this->updatedInvoiceId($id); }
 
    public function updatedPatientId($value)
    {
        if (!$value) return;
        $related = \App\Models\ClinicManagement\Patient::find($value);
        if (!$related) return;
    }

    public function updatedInvoiceId($value)
    {
        if (!$value) return;
        $related = \App\Models\ClinicManagement\ClinicInvoice::find($value);
        if (!$related) return;
    }
 
    protected function getpatientsList() {
        return \App\Models\ClinicManagement\Patient::pluck('name', 'id')->toArray();
    }

    protected function getinvoicesList() {
        return \App\Models\ClinicManagement\ClinicInvoice::pluck('id', 'id')->toArray();
    }

    public function mount(Payment $payment) { $this->item = $payment; $this->fill($payment->toArray());  }
    public function render() {
        abort_if_cannot('edit_payments');
        return view('livewire.admin.clinic-management.payments.edit', [
            'patients' => $this->getpatientsList(),
            'invoices' => $this->getinvoicesList(),
        ])->layout('components.layouts.app');
    }
    public function update(UpdatePaymentAction $action) { $this->validate();  $dto = PaymentDTO::fromArray([
            'patient_id' => $this->patient_id,
            'invoice_id' => $this->invoice_id,
            'amount' => $this->amount,
            'payment_method' => $this->payment_method,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('clinic-management/payments.updated')); return to_route('admin.clinic-management.payments.index'); }
    protected function rules(): array { return Payment::rules($this->item->id); }
}