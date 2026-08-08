<?php

namespace App\Livewire\Admin\RealEstateCRM\PropertyVisits;

use App\Models\RealEstateCRM\PropertyVisit;
use App\Domain\RealEstateCRM\PropertyVisit\Queries\PropertyVisitListQuery;
use App\Domain\RealEstateCRM\PropertyVisit\Actions\DeletePropertyVisitAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('PropertyVisits')]
class PropertyVisits extends Component
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
        abort_if_cannot('view_property_visits');
        $query = (new PropertyVisitListQuery())->handle(['search' => $this->search,             'property_id' => $this->property_id,
            'client_id' => $this->client_id,
], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.real-estate-c-r-m.property-visits.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => PropertyVisit::sortable(),
            'properties' => \App\Models\RealEstateCRM\Property::pluck('title', 'id')->toArray(),
            'clients' => \App\Models\RealEstateCRM\Client::pluck('name', 'id')->toArray(),
        ])->layout('components.layouts.app');
    }

    public function sortBy($field) { if (!in_array($field, PropertyVisit::sortable(), true)) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deletePropertyVisit($id, DeletePropertyVisitAction $action) 
    {
        abort_if_cannot('delete_property_visits');
        $item = PropertyVisit::find($id);
        if (!$item) { $this->dispatch('toast', message: __('real-estate-c-r-m/property-visits.not_found'), type: 'error'); return; }
        try { $action->execute($item); $this->dispatch('toast', message: __('real-estate-c-r-m/property-visits.deleted'), type: 'success'); $this->resetPage(); } 
        catch (\Illuminate\Database\QueryException $e) { $this->dispatch('toast', message: __('real-estate-c-r-m/property-visits.delete_error_referenced'), type: 'error'); }
        catch (\Exception $e) { $this->dispatch('toast', message: __('real-estate-c-r-m/property-visits.delete_error'), type: 'error'); }
    }
}