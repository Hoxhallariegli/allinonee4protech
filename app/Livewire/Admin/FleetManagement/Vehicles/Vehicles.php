<?php

namespace App\Livewire\Admin\FleetManagement\Vehicles;

use App\Models\FleetManagement\Vehicle;
use App\Domain\FleetManagement\Vehicle\Queries\VehicleListQuery;
use App\Domain\FleetManagement\Vehicle\Actions\DeleteVehicleAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;

#[Title('Vehicles')]
class Vehicles extends Component
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
        abort_if_cannot('view_vehicles');
        $query = (new VehicleListQuery())->handle(['search' => $this->search, ], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.fleet-management.vehicles.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => Vehicle::sortable(),
        ])->layout('components.layouts.app');
    }

    public function sortBy($field) { if (!in_array($field, Vehicle::sortable(), true)) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deleteVehicle($id, DeleteVehicleAction $action) 
    {
        abort_if_cannot('delete_vehicles');
        $item = Vehicle::find($id);
        if (!$item) { $this->dispatch('toast', message: __('fleet-management/vehicles.not_found'), type: 'error'); return; }
        try { $action->execute($item); $this->dispatch('toast', message: __('fleet-management/vehicles.deleted'), type: 'success'); $this->resetPage(); } 
        catch (\Illuminate\Database\QueryException $e) { $this->dispatch('toast', message: __('fleet-management/vehicles.delete_error_referenced'), type: 'error'); }
        catch (\Exception $e) { $this->dispatch('toast', message: __('fleet-management/vehicles.delete_error'), type: 'error'); }
    }
}