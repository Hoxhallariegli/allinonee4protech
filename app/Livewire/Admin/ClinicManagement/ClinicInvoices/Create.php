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

#[Title('Add ClinicInvoice')]
class Create extends Component
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

    public function render() {
        abort_if_cannot('add_clinic_invoices');
        return view('livewire.admin.clinic-management.clinic-invoices.create', [
            'visits' => $this->getvisitsList(),
        ])->layout('components.layouts.app');
    }
    public function store(CreateClinicInvoiceAction $action) { $this->validate();  $dto = ClinicInvoiceDTO::fromArray([
            'visit_id' => $this->visit_id,
            'amount' => $this->amount,
            'status' => $this->status,
        ]); $action->execute($dto); session()->flash('success', __('clinic-management/clinic-invoices.created')); return to_route('admin.clinic-management.clinic-invoices.index'); }
    protected function rules(): array { return ClinicInvoice::rules(); }
}