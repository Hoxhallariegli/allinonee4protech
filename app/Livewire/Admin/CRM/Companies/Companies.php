<?php

namespace App\Livewire\Admin\CRM\Companies;

use App\Models\CRM\Company;
use App\Domain\CRM\Company\Queries\CompanyListQuery;
use App\Domain\CRM\Company\Actions\DeleteCompanyAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;

#[Title('Companies')]
class Companies extends Component
{
        use WithPagination, WithFileUploads;

    public int $paginate = 10;
    #[Url(history: true)] public string $search = '';
    public bool $openFilter = false;
    public string $sortField = 'id';
    public bool $sortAsc = true;

    public function resetFilters() { $this->reset(['search', 'openFilter', ]); $this->resetPage(); }

    public function render()
    {
        abort_if_cannot('view_companies');
        $query = (new CompanyListQuery())->handle(['search' => $this->search, ], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.c-r-m.companies.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => Company::sortable(),
        ])->layout('components.layouts.app');
    }

    public function sortBy($field) { if (!in_array($field, Company::sortable(), true)) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deleteCompany($id, DeleteCompanyAction $action) 
    {
        abort_if_cannot('delete_companies');
        $item = Company::find($id);
        if (!$item) { $this->dispatch('toast', message: __('c-r-m/companies.not_found'), type: 'error'); return; }
        try { $action->execute($item); $this->dispatch('toast', message: __('c-r-m/companies.deleted'), type: 'success'); $this->resetPage(); } 
        catch (\Illuminate\Database\QueryException $e) { $this->dispatch('toast', message: __('c-r-m/companies.delete_error_referenced'), type: 'error'); }
        catch (\Exception $e) { $this->dispatch('toast', message: __('c-r-m/companies.delete_error'), type: 'error'); }
    }
}