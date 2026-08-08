<?php

namespace App\Livewire\Admin\ConstructionERP\Payments;

use App\Models\ConstructionERP\Payment;
use App\Domain\ConstructionERP\Payment\Queries\PaymentListQuery;
use App\Domain\ConstructionERP\Payment\Actions\DeletePaymentAction;
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
    #[Url(history: true)] public $client_id = '';
    public bool $openFilter = false;
    public string $sortField = 'id';
    public bool $sortAsc = true;

    public function resetFilters() { $this->reset(['search', 'openFilter', 'client_id', ]); $this->resetPage(); }

    public function render()
    {
        abort_if_cannot('view_payments');
        $query = (new PaymentListQuery())->handle(['search' => $this->search,             'client_id' => $this->client_id,
], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.construction-e-r-p.payments.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => Payment::sortable(),
            'clients' => \App\Models\ConstructionERP\Client::pluck('name', 'id')->toArray(),
        ])->layout('components.layouts.app');
    }

    public function sortBy($field) { if (!in_array($field, Payment::sortable(), true)) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deletePayment($id, DeletePaymentAction $action) 
    {
        abort_if_cannot('delete_payments');
        $item = Payment::find($id);
        if (!$item) { $this->dispatch('toast', message: __('construction-e-r-p/payments.not_found'), type: 'error'); return; }
        try { $action->execute($item); $this->dispatch('toast', message: __('construction-e-r-p/payments.deleted'), type: 'success'); $this->resetPage(); } 
        catch (\Illuminate\Database\QueryException $e) { $this->dispatch('toast', message: __('construction-e-r-p/payments.delete_error_referenced'), type: 'error'); }
        catch (\Exception $e) { $this->dispatch('toast', message: __('construction-e-r-p/payments.delete_error'), type: 'error'); }
    }
}