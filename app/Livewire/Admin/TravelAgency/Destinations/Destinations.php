<?php

namespace App\Livewire\Admin\TravelAgency\Destinations;

use App\Models\TravelAgency\Destination;
use App\Domain\TravelAgency\Destination\Queries\DestinationListQuery;
use App\Domain\TravelAgency\Destination\Actions\DeleteDestinationAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;

#[Title('Destinations')]
class Destinations extends Component
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
        abort_if_cannot('view_destinations');
        $query = (new DestinationListQuery())->handle(['search' => $this->search, ], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.travel-agency.destinations.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => Destination::sortable(),
        ])->layout('components.layouts.app');
    }

    public function sortBy($field) { if (!in_array($field, Destination::sortable(), true)) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deleteDestination($id, DeleteDestinationAction $action) 
    {
        abort_if_cannot('delete_destinations');
        $item = Destination::find($id);
        if (!$item) { $this->dispatch('toast', message: __('travel-agency/destinations.not_found'), type: 'error'); return; }
        try { $action->execute($item); $this->dispatch('toast', message: __('travel-agency/destinations.deleted'), type: 'success'); $this->resetPage(); } 
        catch (\Illuminate\Database\QueryException $e) { $this->dispatch('toast', message: __('travel-agency/destinations.delete_error_referenced'), type: 'error'); }
        catch (\Exception $e) { $this->dispatch('toast', message: __('travel-agency/destinations.delete_error'), type: 'error'); }
    }
}