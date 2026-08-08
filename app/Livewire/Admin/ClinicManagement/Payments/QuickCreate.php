<?php

namespace App\Livewire\Admin\ClinicManagement\Payments;

use App\Models\ClinicManagement\Payment;
use App\Domain\ClinicManagement\Payment\DTOs\PaymentDTO;
use App\Domain\ClinicManagement\Payment\Actions\CreatePaymentAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

class QuickCreate extends Component
{
        use WithPagination;
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

    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.clinic-management.payments.quick-create', [
            'patients' => $this->getpatientsList(),
            'invoices' => $this->getinvoicesList(),
        ]); }

    public function store(CreatePaymentAction $action)
    {
        $this->validate();
        $dto = PaymentDTO::fromArray([
            'patient_id' => $this->patient_id,
            'invoice_id' => $this->invoice_id,
            'amount' => $this->amount,
            'payment_method' => $this->payment_method,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('payment-created', id: $item->id);
        $this->js("Livewire.dispatch('payment-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('clinic-management/payments.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->id ?? $item->id);
        $this->reset(['patient_id', 'invoice_id', 'amount', 'payment_method']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return Payment::rules(); }
}