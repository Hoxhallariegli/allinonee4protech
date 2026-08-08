<?php

namespace App\Livewire\Admin\ClinicManagement\ClinicInvoices;

use App\Models\ClinicManagement\ClinicInvoice;
use App\Domain\ClinicManagement\ClinicInvoice\DTOs\ClinicInvoiceDTO;
use App\Domain\ClinicManagement\ClinicInvoice\Actions\UpdateClinicInvoiceAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Edit ClinicInvoice')]
class Edit extends Component
{
        use WithPagination;
 public ClinicInvoice $item;
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

    public function mount(ClinicInvoice $clinicInvoice) { $this->item = $clinicInvoice; $this->fill($clinicInvoice->toArray());  }
    public function render() {
        abort_if_cannot('edit_clinic_invoices');
        return view('livewire.admin.clinic-management.clinic-invoices.edit', [
            'visits' => $this->getvisitsList(),
        ])->layout('components.layouts.app');
    }
    public function update(UpdateClinicInvoiceAction $action) { $this->validate();  $dto = ClinicInvoiceDTO::fromArray([
            'visit_id' => $this->visit_id,
            'amount' => $this->amount,
            'status' => $this->status,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('clinic-management/clinic-invoices.updated')); return to_route('admin.clinic-management.clinic-invoices.index'); }
    protected function rules(): array { return ClinicInvoice::rules($this->item->id); }
}