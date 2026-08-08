<?php

namespace App\Livewire\Admin\AutoRepairManagement\Invoices;

use App\Models\AutoRepairManagement\Invoice;
use App\Domain\AutoRepairManagement\Invoice\DTOs\InvoiceDTO;
use App\Domain\AutoRepairManagement\Invoice\Actions\CreateInvoiceAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Add Invoice')]
class Create extends Component
{
        use WithPagination;
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

    public function render() {
        abort_if_cannot('add_invoices');
        return view('livewire.admin.auto-repair-management.invoices.create', [
            'jobCards' => $this->getjobCardsList(),
        ])->layout('components.layouts.app');
    }
    public function store(CreateInvoiceAction $action) { $this->validate();  $dto = InvoiceDTO::fromArray([
            'job_card_id' => $this->job_card_id,
            'invoice_date' => $this->invoice_date,
            'total' => $this->total,
            'status' => $this->status,
        ]); $action->execute($dto); session()->flash('success', __('auto-repair-management/invoices.created')); return to_route('admin.auto-repair-management.invoices.index'); }
    protected function rules(): array { return Invoice::rules(); }
}