<?php

namespace App\Livewire\Admin\ClinicManagement\ClinicInvoices;

use App\Models\ClinicManagement\ClinicInvoice;
use App\Domain\ClinicManagement\ClinicInvoice\DTOs\ClinicInvoiceDTO;
use App\Domain\ClinicManagement\ClinicInvoice\Actions\CreateClinicInvoiceAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

class QuickCreate extends Component
{
        use WithPagination;
     public $visit_id = '';
    public $amount = '';
    public $status = '';
 
    #[On('visit-created')] 
    public function refreshVisits($id) { $this->visit_id = $id; $this->updatedVisitId($id); }
 
    public function updatedVisitId($value)
    {
        if (!$value) return;
        $related = \App\Models\ClinicManagement\Visit::find($value);
        if (!$related) return;
    }
 
    protected function getvisitsList() {
        return \App\Models\ClinicManagement\Visit::pluck('id', 'id')->toArray();
    }

    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.clinic-management.clinic-invoices.quick-create', [
            'visits' => $this->getvisitsList(),
        ]); }

    public function store(CreateClinicInvoiceAction $action)
    {
        $this->validate();
        $dto = ClinicInvoiceDTO::fromArray([
            'visit_id' => $this->visit_id,
            'amount' => $this->amount,
            'status' => $this->status,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('clinic-invoice-created', id: $item->id);
        $this->js("Livewire.dispatch('clinic-invoice-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('clinic-management/clinic-invoices.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->id ?? $item->id);
        $this->reset(['visit_id', 'amount', 'status']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return ClinicInvoice::rules(); }
}