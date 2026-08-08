<?php

namespace App\Livewire\Admin\FleetManagement\Shipments;

use App\Models\FleetManagement\Shipment;
use App\Domain\FleetManagement\Shipment\Queries\ShipmentListQuery;
use App\Domain\FleetManagement\Shipment\Actions\DeleteShipmentAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Shipments')]
class Shipments extends Component
{
        use WithPagination;

    public int $paginate = 10;
    #[Url(history: true)] public string $search = '';
    #[Url(history: true)] public $vehicle_id = '';
    #[Url(history: true)] public $driver_id = '';
    public bool $openFilter = false;
    public string $sortField = 'id';
    public bool $sortAsc = true;

    public function resetFilters() { $this->reset(['search', 'openFilter', 'vehicle_id', 'driver_id', ]); $this->resetPage(); }

    public function render()
    {
        abort_if_cannot('view_shipments');
        $query = (new ShipmentListQuery())->handle(['search' => $this->search,             'vehicle_id' => $this->vehicle_id,
            'driver_id' => $this->driver_id,
], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.fleet-management.shipments.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => Shipment::sortable(),
            'vehicles' => \App\Models\FleetManagement\Vehicle::pluck('license_plate', 'id')->toArray(),
            'drivers' => \App\Models\FleetManagement\Driver::pluck('name', 'id')->toArray(),
        ])->layout('components.layouts.app');
    }

    public function sortBy($field) { if (!in_array($field, Shipment::sortable(), true)) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deleteShipment($id, DeleteShipmentAction $action) 
    {
        abort_if_cannot('delete_shipments');
        $item = Shipment::find($id);
        if (!$item) { $this->dispatch('toast', message: __('fleet-management/shipments.not_found'), type: 'error'); return; }
        try { $action->execute($item); $this->dispatch('toast', message: __('fleet-management/shipments.deleted'), type: 'success'); $this->resetPage(); } 
        catch (\Illuminate\Database\QueryException $e) { $this->dispatch('toast', message: __('fleet-management/shipments.delete_error_referenced'), type: 'error'); }
        catch (\Exception $e) { $this->dispatch('toast', message: __('fleet-management/shipments.delete_error'), type: 'error'); }
    }
}