<?php

namespace App\Livewire\Admin\AutoRepairManagement\Invoices;

use App\Models\AutoRepairManagement\Invoice;
use App\Domain\AutoRepairManagement\Invoice\DTOs\InvoiceDTO;
use App\Domain\AutoRepairManagement\Invoice\Actions\UpdateInvoiceAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Edit Invoice')]
class Edit extends Component
{
        use WithPagination;
 public Invoice $item;
    public $job_card_id = '';
    public $invoice_date = '';
    public $total = '';
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

    public function mount(Invoice $invoice) { $this->item = $invoice; $this->fill($invoice->toArray()); $this->invoice_date = $invoice->invoice_date?->format('Y-m-d'); }
    public function render() {
        abort_if_cannot('edit_invoices');
        return view('livewire.admin.auto-repair-management.invoices.edit', [
            'jobCards' => $this->getjobCardsList(),
        ])->layout('components.layouts.app');
    }
    public function update(UpdateInvoiceAction $action) { $this->validate();  $dto = InvoiceDTO::fromArray([
            'job_card_id' => $this->job_card_id,
            'invoice_date' => $this->invoice_date,
            'total' => $this->total,
            'status' => $this->status,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('auto-repair-management/invoices.updated')); return to_route('admin.auto-repair-management.invoices.index'); }
    protected function rules(): array { return Invoice::rules($this->item->id); }
}