<?php

namespace App\Livewire\Admin\RealEstateCRM\Contracts;

use App\Models\RealEstateCRM\Contract;
use App\Domain\RealEstateCRM\Contract\Queries\ContractListQuery;
use App\Domain\RealEstateCRM\Contract\Actions\DeleteContractAction;
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
    #[Url(history: true)] public $property_id = '';
    #[Url(history: true)] public $client_id = '';
    public bool $openFilter = false;
    public string $sortField = 'id';
    public bool $sortAsc = true;

    public function resetFilters() { $this->reset(['search', 'openFilter', 'property_id', 'client_id', ]); $this->resetPage(); }

    public function render()
    {
        abort_if_cannot('view_contracts');
        $query = (new ContractListQuery())->handle(['search' => $this->search,             'property_id' => $this->property_id,
            'client_id' => $this->client_id,
], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.real-estate-c-r-m.contracts.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => Contract::sortable(),
            'properties' => \App\Models\RealEstateCRM\Property::pluck('title', 'id')->toArray(),
            'clients' => \App\Models\RealEstateCRM\Client::pluck('name', 'id')->toArray(),
        ])->layout('components.layouts.app');
    }

    public function sortBy($field) { if (!in_array($field, Contract::sortable(), true)) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deleteContract($id, DeleteContractAction $action) 
    {
        abort_if_cannot('delete_contracts');
        $item = Contract::find($id);
        if (!$item) { $this->dispatch('toast', message: __('real-estate-c-r-m/contracts.not_found'), type: 'error'); return; }
        try { $action->execute($item); $this->dispatch('toast', message: __('real-estate-c-r-m/contracts.deleted'), type: 'success'); $this->resetPage(); } 
        catch (\Illuminate\Database\QueryException $e) { $this->dispatch('toast', message: __('real-estate-c-r-m/contracts.delete_error_referenced'), type: 'error'); }
        catch (\Exception $e) { $this->dispatch('toast', message: __('real-estate-c-r-m/contracts.delete_error'), type: 'error'); }
    }
}