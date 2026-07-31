<?php

namespace App\Livewire\Admin\ClinicManagement\ClinicInvoices;

use App\Models\ClinicManagement\ClinicInvoice;
use App\Domain\ClinicManagement\ClinicInvoice\Queries\ClinicInvoiceListQuery;
use App\Domain\ClinicManagement\ClinicInvoice\Actions\DeleteClinicInvoiceAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('ClinicInvoices')]
class ClinicInvoices extends Component
{
        use WithPagination;

    public int $paginate = 10;
    #[Url(history: true)] public string $search = '';
    #[Url(history: true)] public $visit_id = '';
    public bool $openFilter = false;
    public string $sortField = 'id';
    public bool $sortAsc = true;

    public function resetFilters() { $this->reset(['search', 'openFilter', 'visit_id', ]); $this->resetPage(); }

    public function render()
    {
        abort_if_cannot('view_clinic_invoices');
        $query = (new ClinicInvoiceListQuery())->handle(['search' => $this->search,             'visit_id' => $this->visit_id,
], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.clinic-management.clinic-invoices.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => ClinicInvoice::sortable(),
            'visits' => \App\Models\ClinicManagement\Visit::with('patient')->get()->pluck('patient.name', 'id')->toArray(),
        ])->layout('components.layouts.app');
    }

    public function sortBy($field) { if (!in_array($field, ClinicInvoice::sortable(), true)) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deleteClinicInvoice($id, DeleteClinicInvoiceAction $action) 
    {
        abort_if_cannot('delete_clinic_invoices');
        $item = ClinicInvoice::find($id);
        if (!$item) { $this->dispatch('toast', message: __('clinic-management/clinic-invoices.not_found'), type: 'error'); return; }
        try { $action->execute($item); $this->dispatch('toast', message: __('clinic-management/clinic-invoices.deleted'), type: 'success'); $this->resetPage(); } 
        catch (\Illuminate\Database\QueryException $e) { $this->dispatch('toast', message: __('clinic-management/clinic-invoices.delete_error_referenced'), type: 'error'); }
        catch (\Exception $e) { $this->dispatch('toast', message: __('clinic-management/clinic-invoices.delete_error'), type: 'error'); }
    }
}