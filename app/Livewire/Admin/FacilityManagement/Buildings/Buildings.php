<?php

namespace App\Livewire\Admin\FacilityManagement\Buildings;

use App\Models\FacilityManagement\Building;
use App\Domain\FacilityManagement\Building\Queries\BuildingListQuery;
use App\Domain\FacilityManagement\Building\Actions\DeleteBuildingAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Buildings')]
class Buildings extends Component
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
        abort_if_cannot('view_buildings');
        $query = (new BuildingListQuery())->handle(['search' => $this->search, ], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.facility-management.buildings.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => Building::sortable(),
        ])->layout('components.layouts.app');
    }

    public function sortBy($field) { if (!in_array($field, Building::sortable(), true)) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deleteBuilding($id, DeleteBuildingAction $action) 
    {
        abort_if_cannot('delete_buildings');
        $item = Building::find($id);
        if (!$item) { $this->dispatch('toast', message: __('facility-management/buildings.not_found'), type: 'error'); return; }
        try { $action->execute($item); $this->dispatch('toast', message: __('facility-management/buildings.deleted'), type: 'success'); $this->resetPage(); } 
        catch (\Illuminate\Database\QueryException $e) { $this->dispatch('toast', message: __('facility-management/buildings.delete_error_referenced'), type: 'error'); }
        catch (\Exception $e) { $this->dispatch('toast', message: __('facility-management/buildings.delete_error'), type: 'error'); }
    }
}