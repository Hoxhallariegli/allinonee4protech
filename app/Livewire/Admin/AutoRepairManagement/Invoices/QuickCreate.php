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

class QuickCreate extends Component
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

    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.auto-repair-management.invoices.quick-create', [
            'jobCards' => $this->getjobCardsList(),
        ]); }

    public function store(CreateInvoiceAction $action)
    {
        $this->validate();
        $dto = InvoiceDTO::fromArray([
            'job_card_id' => $this->job_card_id,
            'invoice_date' => $this->invoice_date,
            'total' => $this->total,
            'status' => $this->status,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('invoice-created', id: $item->id);
        $this->js("Livewire.dispatch('invoice-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('auto-repair-management/invoices.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->id ?? $item->id);
        $this->reset(['job_card_id', 'invoice_date', 'total', 'status']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return Invoice::rules(); }
}