<?php

namespace App\Livewire\Admin\ConstructionERP\Clients;

use App\Models\ConstructionERP\Client;
use App\Domain\ConstructionERP\Client\Queries\ClientListQuery;
use App\Domain\ConstructionERP\Client\Actions\DeleteClientAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Clients')]
class Clients extends Component
{
        use WithPagination;

    public int $paginate = 10;
    #[Url(history: true)] public string $search = '';
    public bool $openFilter = false;
    public string $sortField = 'id';
    public bool $sortAsc = true;

    public function resetFilters() { $this->reset(['search', 'openFilter', ]); $this->resetPage(); }

    public function render()
    {
        abort_if_cannot('view_clients');
        $query = (new ClientListQuery())->handle(['search' => $this->search, ], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.construction-e-r-p.clients.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => Client::sortable(),
        ])->layout('components.layouts.app');
    }

    public function sortBy($field) { if (!in_array($field, Client::sortable(), true)) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deleteClient($id, DeleteClientAction $action) 
    {
        abort_if_cannot('delete_clients');
        $item = Client::find($id);
        if (!$item) { $this->dispatch('toast', message: __('construction-e-r-p/clients.not_found'), type: 'error'); return; }
        try { $action->execute($item); $this->dispatch('toast', message: __('construction-e-r-p/clients.deleted'), type: 'success'); $this->resetPage(); } 
        catch (\Illuminate\Database\QueryException $e) { $this->dispatch('toast', message: __('construction-e-r-p/clients.delete_error_referenced'), type: 'error'); }
        catch (\Exception $e) { $this->dispatch('toast', message: __('construction-e-r-p/clients.delete_error'), type: 'error'); }
    }
}