<?php

namespace App\Livewire\Admin\LegalManagement\Billings;

use App\Models\LegalManagement\Billing;
use App\Domain\LegalManagement\Billing\Queries\BillingListQuery;
use App\Domain\LegalManagement\Billing\Actions\DeleteBillingAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Billings')]
class Billings extends Component
{
        use WithPagination;

    public int $paginate = 10;
    #[Url(history: true)] public string $search = '';
    #[Url(history: true)] public $case_id = '';
    public bool $openFilter = false;
    public string $sortField = 'id';
    public bool $sortAsc = true;

    public function resetFilters() { $this->reset(['search', 'openFilter', 'case_id', ]); $this->resetPage(); }

    public function render()
    {
        abort_if_cannot('view_billings');
        $query = (new BillingListQuery())->handle(['search' => $this->search,             'case_id' => $this->case_id,
], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.legal-management.billings.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => Billing::sortable(),
            'cases' => \App\Models\LegalManagement\LegalCase::pluck('title', 'id')->toArray(),
        ])->layout('components.layouts.app');
    }

    public function sortBy($field) { if (!in_array($field, Billing::sortable(), true)) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deleteBilling($id, DeleteBillingAction $action) 
    {
        abort_if_cannot('delete_billings');
        $item = Billing::find($id);
        if (!$item) { $this->dispatch('toast', message: __('legal-management/billings.not_found'), type: 'error'); return; }
        try { $action->execute($item); $this->dispatch('toast', message: __('legal-management/billings.deleted'), type: 'success'); $this->resetPage(); } 
        catch (\Illuminate\Database\QueryException $e) { $this->dispatch('toast', message: __('legal-management/billings.delete_error_referenced'), type: 'error'); }
        catch (\Exception $e) { $this->dispatch('toast', message: __('legal-management/billings.delete_error'), type: 'error'); }
    }
}