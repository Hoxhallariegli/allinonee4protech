<?php

namespace App\Livewire\Admin\AutoRepairManagement\InvoiceItems;

use App\Models\AutoRepairManagement\InvoiceItem;
use App\Domain\AutoRepairManagement\InvoiceItem\DTOs\InvoiceItemDTO;
use App\Domain\AutoRepairManagement\InvoiceItem\Actions\UpdateInvoiceItemAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Edit InvoiceItem')]
class Edit extends Component
{
        use WithPagination;
 public InvoiceItem $item;
    public $invoice_id = '';
    public $service_id = '';
    public $part_id = '';
    public $quantity = '';
    public $price = '';
 
    #[On('invoice-created')] 
    public function refreshInvoices($id) { $this->invoice_id = $id; $this->updatedInvoiceId($id); }

    #[On('service-created')] 
    public function refreshServices($id) { $this->service_id = $id; $this->updatedServiceId($id); }

    #[On('part-created')] 
    public function refreshParts($id) { $this->part_id = $id; $this->updatedPartId($id); }
 
    public function updatedInvoiceId($value)
    {
        if (!$value) return;
        $related = \App\Models\AutoRepairManagement\Invoice::find($value);
        if (!$related) return;
    }

    public function updatedServiceId($value)
    {
        if (!$value) return;
        $related = \App\Models\AutoRepairManagement\Service::find($value);
        if (!$related) return;
    }

    public function updatedPartId($value)
    {
        if (!$value) return;
        $related = \App\Models\AutoRepairManagement\Part::find($value);
        if (!$related) return;
    }
 
    protected function getinvoicesList() {
        return \App\Models\AutoRepairManagement\Invoice::pluck('id', 'id')->toArray();
    }

    protected function getservicesList() {
        return \App\Models\AutoRepairManagement\Service::pluck('name', 'id')->toArray();
    }

    protected function getpartsList() {
        return \App\Models\AutoRepairManagement\Part::pluck('name', 'id')->toArray();
    }

    public function mount(InvoiceItem $invoiceItem) { $this->item = $invoiceItem; $this->fill($invoiceItem->toArray());  }
    public function render() {
        abort_if_cannot('edit_invoice_items');
        return view('livewire.admin.auto-repair-management.invoice-items.edit', [
            'invoices' => $this->getinvoicesList(),
            'services' => $this->getservicesList(),
            'parts' => $this->getpartsList(),
        ])->layout('components.layouts.app');
    }
    public function update(UpdateInvoiceItemAction $action) { $this->validate();  $dto = InvoiceItemDTO::fromArray([
            'invoice_id' => $this->invoice_id,
            'service_id' => $this->service_id,
            'part_id' => $this->part_id,
            'quantity' => $this->quantity,
            'price' => $this->price,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('auto-repair-management/invoice-items.updated')); return to_route('admin.auto-repair-management.invoice-items.index'); }
    protected function rules(): array { return InvoiceItem::rules($this->item->id); }
}