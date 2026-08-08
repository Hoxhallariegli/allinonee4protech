<?php

namespace App\Livewire\Admin\RealEstateCRM\ClientAddresses;

use App\Models\RealEstateCRM\ClientAddress;
use App\Domain\RealEstateCRM\ClientAddress\Queries\ClientAddressListQuery;
use App\Domain\RealEstateCRM\ClientAddress\Actions\DeleteClientAddressAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('ClientAddresses')]
class ClientAddresses extends Component
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
        abort_if_cannot('view_client_addresses');
        $query = (new ClientAddressListQuery())->handle(['search' => $this->search,             'client_id' => $this->client_id,
], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.real-estate-c-r-m.client-addresses.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => ClientAddress::sortable(),
            'clients' => \App\Models\RealEstateCRM\Client::pluck('name', 'id')->toArray(),
        ])->layout('components.layouts.app');
    }

    public function sortBy($field) { if (!in_array($field, ClientAddress::sortable(), true)) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deleteClientAddress($id, DeleteClientAddressAction $action) 
    {
        abort_if_cannot('delete_client_addresses');
        $item = ClientAddress::find($id);
        if (!$item) { $this->dispatch('toast', message: __('real-estate-c-r-m/client-addresses.not_found'), type: 'error'); return; }
        try { $action->execute($item); $this->dispatch('toast', message: __('real-estate-c-r-m/client-addresses.deleted'), type: 'success'); $this->resetPage(); } 
        catch (\Illuminate\Database\QueryException $e) { $this->dispatch('toast', message: __('real-estate-c-r-m/client-addresses.delete_error_referenced'), type: 'error'); }
        catch (\Exception $e) { $this->dispatch('toast', message: __('real-estate-c-r-m/client-addresses.delete_error'), type: 'error'); }
    }
}