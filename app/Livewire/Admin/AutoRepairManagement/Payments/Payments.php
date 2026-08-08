<?php

namespace App\Livewire\Admin\AutoRepairManagement\Payments;

use App\Models\AutoRepairManagement\Payment;
use App\Domain\AutoRepairManagement\Payment\Queries\PaymentListQuery;
use App\Domain\AutoRepairManagement\Payment\Actions\DeletePaymentAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Payments')]
class Payments extends Component
{
        use WithPagination;

    public int $paginate = 10;
    #[Url(history: true)] public string $search = '';
    #[Url(history: true)] public $job_card_id = '';
    public bool $openFilter = false;
    public string $sortField = 'id';
    public bool $sortAsc = true;

    public function resetFilters() { $this->reset(['search', 'openFilter', 'job_card_id', ]); $this->resetPage(); }

    public function render()
    {
        abort_if_cannot('view_payments');
        $query = (new PaymentListQuery())->handle(['search' => $this->search,             'job_card_id' => $this->job_card_id,
], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.auto-repair-management.payments.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => Payment::sortable(),
            'jobCards' => \App\Models\AutoRepairManagement\JobCard::pluck('id', 'id')->toArray(),
        ])->layout('components.layouts.app');
    }

    public function sortBy($field) { if (!in_array($field, Payment::sortable(), true)) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deletePayment($id, DeletePaymentAction $action) 
    {
        abort_if_cannot('delete_payments');
        $item = Payment::find($id);
        if (!$item) { $this->dispatch('toast', message: __('auto-repair-management/payments.not_found'), type: 'error'); return; }
        try { $action->execute($item); $this->dispatch('toast', message: __('auto-repair-management/payments.deleted'), type: 'success'); $this->resetPage(); } 
        catch (\Illuminate\Database\QueryException $e) { $this->dispatch('toast', message: __('auto-repair-management/payments.delete_error_referenced'), type: 'error'); }
        catch (\Exception $e) { $this->dispatch('toast', message: __('auto-repair-management/payments.delete_error'), type: 'error'); }
    }
}