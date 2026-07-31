<?php

namespace App\Livewire\Admin\ConstructionERP\Apartments;

use App\Models\ConstructionERP\Apartment;
use App\Domain\ConstructionERP\Apartment\Queries\ApartmentListQuery;
use App\Domain\ConstructionERP\Apartment\Actions\DeleteApartmentAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Apartments')]
class Apartments extends Component
{
        use WithPagination;

    public int $paginate = 10;
    #[Url(history: true)] public string $search = '';
    #[Url(history: true)] public $building_id = '';
    public bool $openFilter = false;
    public string $sortField = 'id';
    public bool $sortAsc = true;

    public function resetFilters() { $this->reset(['search', 'openFilter', 'building_id', ]); $this->resetPage(); }

    public function render()
    {
        abort_if_cannot('view_apartments');
        $query = (new ApartmentListQuery())->handle(['search' => $this->search,             'building_id' => $this->building_id,
], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.construction-e-r-p.apartments.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => Apartment::sortable(),
            'buildings' => \App\Models\ConstructionERP\Building::pluck('name', 'id')->toArray(),
        ])->layout('components.layouts.app');
    }

    public function sortBy($field) { if (!in_array($field, Apartment::sortable(), true)) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deleteApartment($id, DeleteApartmentAction $action) 
    {
        abort_if_cannot('delete_apartments');
        $item = Apartment::find($id);
        if (!$item) { $this->dispatch('toast', message: __('construction-e-r-p/apartments.not_found'), type: 'error'); return; }
        try { $action->execute($item); $this->dispatch('toast', message: __('construction-e-r-p/apartments.deleted'), type: 'success'); $this->resetPage(); } 
        catch (\Illuminate\Database\QueryException $e) { $this->dispatch('toast', message: __('construction-e-r-p/apartments.delete_error_referenced'), type: 'error'); }
        catch (\Exception $e) { $this->dispatch('toast', message: __('construction-e-r-p/apartments.delete_error'), type: 'error'); }
    }
}