<?php

namespace App\Livewire\Admin\InvoiceItems;

use App\Models\InvoiceItem;
use App\Domain\InvoiceItem\DTOs\InvoiceItemDTO;
use App\Domain\InvoiceItem\Actions\CreateInvoiceItemAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

class QuickCreate extends Component
{
        use WithPagination;
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
        $related = \App\Models\Invoice::find($value);
        if (!$related) return;
        if (isset($related->service_id)) { $this->service_id = $related->service_id; }
        if (isset($related->part_id)) { $this->part_id = $related->part_id; }
    }

    public function updatedServiceId($value)
    {
        if (!$value) return;
        $related = \App\Models\Service::find($value);
        if (!$related) return;
        if (isset($related->invoice_id)) { $this->invoice_id = $related->invoice_id; }
        if (isset($related->part_id)) { $this->part_id = $related->part_id; }
    }

    public function updatedPartId($value)
    {
        if (!$value) return;
        $related = \App\Models\Part::find($value);
        if (!$related) return;
        if (isset($related->invoice_id)) { $this->invoice_id = $related->invoice_id; }
        if (isset($related->service_id)) { $this->service_id = $related->service_id; }
    }
 
    protected function getinvoicesList() {
        return \App\Models\Invoice::pluck('id', 'id')->toArray();
    }

    protected function getservicesList() {
        return \App\Models\Service::pluck('name', 'id')->toArray();
    }

    protected function getpartsList() {
        return \App\Models\Part::pluck('name', 'id')->toArray();
    }

    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.invoice-items.quick-create', [
            'invoices' => $this->getinvoicesList(),
            'services' => $this->getservicesList(),
            'parts' => $this->getpartsList(),
        ]); }

    public function store(CreateInvoiceItemAction $action)
    {
        $this->validate();
        $dto = InvoiceItemDTO::fromArray([
            'invoice_id' => $this->invoice_id,
            'service_id' => $this->service_id,
            'part_id' => $this->part_id,
            'quantity' => $this->quantity,
            'price' => $this->price,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('invoice-item-created', id: $item->id);
        $this->js("Livewire.dispatch('invoice-item-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('invoice-items.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->id ?? $item->id);
        $this->reset(['invoice_id', 'service_id', 'part_id', 'quantity', 'price']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return InvoiceItem::rules(); }
}