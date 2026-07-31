<?php

namespace App\Livewire\Admin\AutoRepairManagement\Vehicles;

use App\Models\AutoRepairManagement\Vehicle;
use App\Domain\AutoRepairManagement\Vehicle\Queries\VehicleListQuery;
use App\Domain\AutoRepairManagement\Vehicle\Actions\DeleteVehicleAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Vehicles')]
class Vehicles extends Component
{
        use WithPagination;

    public int $paginate = 10;
    #[Url(history: true)] public string $search = '';
    #[Url(history: true)] public $brand_id = '';
    #[Url(history: true)] public $model_id = '';
    #[Url(history: true)] public $customer_id = '';
    public bool $openFilter = false;
    public string $sortField = 'id';
    public bool $sortAsc = true;

    public function resetFilters() { $this->reset(['search', 'openFilter', 'brand_id', 'model_id', 'customer_id', ]); $this->resetPage(); }

    public function render()
    {
        abort_if_cannot('view_vehicles');
        $query = (new VehicleListQuery())->handle(['search' => $this->search,             'brand_id' => $this->brand_id,
            'model_id' => $this->model_id,
            'customer_id' => $this->customer_id,
], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.auto-repair-management.vehicles.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => Vehicle::sortable(),
            'brands' => \App\Models\AutoRepairManagement\VehicleBrand::pluck('name', 'id')->toArray(),
            'models' => \App\Models\AutoRepairManagement\VehicleModel::pluck('name', 'id')->toArray(),
            'customers' => \App\Models\AutoRepairManagement\Customer::pluck('name', 'id')->toArray(),
        ])->layout('components.layouts.app');
    }

    public function sortBy($field) { if (!in_array($field, Vehicle::sortable(), true)) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deleteVehicle($id, DeleteVehicleAction $action) 
    {
        abort_if_cannot('delete_vehicles');
        $item = Vehicle::find($id);
        if (!$item) { $this->dispatch('toast', message: __('auto-repair-management/vehicles.not_found'), type: 'error'); return; }
        try { $action->execute($item); $this->dispatch('toast', message: __('auto-repair-management/vehicles.deleted'), type: 'success'); $this->resetPage(); } 
        catch (\Illuminate\Database\QueryException $e) { $this->dispatch('toast', message: __('auto-repair-management/vehicles.delete_error_referenced'), type: 'error'); }
        catch (\Exception $e) { $this->dispatch('toast', message: __('auto-repair-management/vehicles.delete_error'), type: 'error'); }
    }
}