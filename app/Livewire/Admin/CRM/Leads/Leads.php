<?php

namespace App\Livewire\Admin\CRM\Leads;

use App\Models\CRM\Lead;
use App\Domain\CRM\Lead\Queries\LeadListQuery;
use App\Domain\CRM\Lead\Actions\DeleteLeadAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Leads')]
class Leads extends Component
{
        use WithPagination;

    public int $paginate = 10;
    #[Url(history: true)] public string $search = '';
    #[Url(history: true)] public $company_id = '';
    public bool $openFilter = false;
    public string $sortField = 'id';
    public bool $sortAsc = true;

    public function resetFilters() { $this->reset(['search', 'openFilter', 'company_id', ]); $this->resetPage(); }

    public function render()
    {
        abort_if_cannot('view_leads');
        $query = (new LeadListQuery())->handle(['search' => $this->search,             'company_id' => $this->company_id,
], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.c-r-m.leads.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => Lead::sortable(),
            'companies' => \App\Models\CRM\Company::pluck('name', 'id')->toArray(),
        ])->layout('components.layouts.app');
    }

    public function sortBy($field) { if (!in_array($field, Lead::sortable(), true)) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deleteLead($id, DeleteLeadAction $action) 
    {
        abort_if_cannot('delete_leads');
        $item = Lead::find($id);
        if (!$item) { $this->dispatch('toast', message: __('c-r-m/leads.not_found'), type: 'error'); return; }
        try { $action->execute($item); $this->dispatch('toast', message: __('c-r-m/leads.deleted'), type: 'success'); $this->resetPage(); } 
        catch (\Illuminate\Database\QueryException $e) { $this->dispatch('toast', message: __('c-r-m/leads.delete_error_referenced'), type: 'error'); }
        catch (\Exception $e) { $this->dispatch('toast', message: __('c-r-m/leads.delete_error'), type: 'error'); }
    }
}