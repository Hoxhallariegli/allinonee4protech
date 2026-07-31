<?php

namespace App\Livewire\Admin\ConstructionERP\Contracts;

use App\Models\ConstructionERP\Contract;
use App\Domain\ConstructionERP\Contract\Queries\ContractListQuery;
use App\Domain\ConstructionERP\Contract\Actions\DeleteContractAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Contracts')]
class Contracts extends Component
{
        use WithPagination;

    public int $paginate = 10;
    #[Url(history: true)] public string $search = '';
    #[Url(history: true)] public $project_id = '';
    #[Url(history: true)] public $client_id = '';
    public bool $openFilter = false;
    public string $sortField = 'id';
    public bool $sortAsc = true;

    public function resetFilters() { $this->reset(['search', 'openFilter', 'project_id', 'client_id', ]); $this->resetPage(); }

    public function render()
    {
        abort_if_cannot('view_contracts');
        $query = (new ContractListQuery())->handle(['search' => $this->search,             'project_id' => $this->project_id,
            'client_id' => $this->client_id,
], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.construction-e-r-p.contracts.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => Contract::sortable(),
            'projects' => \App\Models\ConstructionERP\Project::pluck('name', 'id')->toArray(),
            'clients' => \App\Models\ConstructionERP\Client::pluck('name', 'id')->toArray(),
        ])->layout('components.layouts.app');
    }

    public function sortBy($field) { if (!in_array($field, Contract::sortable(), true)) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deleteContract($id, DeleteContractAction $action) 
    {
        abort_if_cannot('delete_contracts');
        $item = Contract::find($id);
        if (!$item) { $this->dispatch('toast', message: __('construction-e-r-p/contracts.not_found'), type: 'error'); return; }
        try { $action->execute($item); $this->dispatch('toast', message: __('construction-e-r-p/contracts.deleted'), type: 'success'); $this->resetPage(); } 
        catch (\Illuminate\Database\QueryException $e) { $this->dispatch('toast', message: __('construction-e-r-p/contracts.delete_error_referenced'), type: 'error'); }
        catch (\Exception $e) { $this->dispatch('toast', message: __('construction-e-r-p/contracts.delete_error'), type: 'error'); }
    }
}