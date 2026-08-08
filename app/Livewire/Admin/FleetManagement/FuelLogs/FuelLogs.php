<?php

namespace App\Livewire\Admin\FleetManagement\FuelLogs;

use App\Models\FleetManagement\FuelLog;
use App\Domain\FleetManagement\FuelLog\Queries\FuelLogListQuery;
use App\Domain\FleetManagement\FuelLog\Actions\DeleteFuelLogAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('FuelLogs')]
class FuelLogs extends Component
{
        use WithPagination;

    public int $paginate = 10;
    #[Url(history: true)] public string $search = '';
    #[Url(history: true)] public $vehicle_id = '';
    public bool $openFilter = false;
    public string $sortField = 'id';
    public bool $sortAsc = true;

    public function resetFilters() { $this->reset(['search', 'openFilter', 'vehicle_id', ]); $this->resetPage(); }

    public function render()
    {
        abort_if_cannot('view_fuel_logs');
        $query = (new FuelLogListQuery())->handle(['search' => $this->search,             'vehicle_id' => $this->vehicle_id,
], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.fleet-management.fuel-logs.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => FuelLog::sortable(),
            'vehicles' => \App\Models\FleetManagement\Vehicle::pluck('license_plate', 'id')->toArray(),
        ])->layout('components.layouts.app');
    }

    public function sortBy($field) { if (!in_array($field, FuelLog::sortable(), true)) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deleteFuelLog($id, DeleteFuelLogAction $action) 
    {
        abort_if_cannot('delete_fuel_logs');
        $item = FuelLog::find($id);
        if (!$item) { $this->dispatch('toast', message: __('fleet-management/fuel-logs.not_found'), type: 'error'); return; }
        try { $action->execute($item); $this->dispatch('toast', message: __('fleet-management/fuel-logs.deleted'), type: 'success'); $this->resetPage(); } 
        catch (\Illuminate\Database\QueryException $e) { $this->dispatch('toast', message: __('fleet-management/fuel-logs.delete_error_referenced'), type: 'error'); }
        catch (\Exception $e) { $this->dispatch('toast', message: __('fleet-management/fuel-logs.delete_error'), type: 'error'); }
    }
}