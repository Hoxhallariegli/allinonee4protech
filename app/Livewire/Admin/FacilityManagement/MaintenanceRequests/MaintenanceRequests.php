<?php

namespace App\Livewire\Admin\FacilityManagement\MaintenanceRequests;

use App\Models\FacilityManagement\MaintenanceRequest;
use App\Domain\FacilityManagement\MaintenanceRequest\Queries\MaintenanceRequestListQuery;
use App\Domain\FacilityManagement\MaintenanceRequest\Actions\DeleteMaintenanceRequestAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('MaintenanceRequests')]
class MaintenanceRequests extends Component
{
        use WithPagination;

    public int $paginate = 10;
    #[Url(history: true)] public string $search = '';
    #[Url(history: true)] public $building_id = '';
    #[Url(history: true)] public $technician_id = '';
    public bool $openFilter = false;
    public string $sortField = 'id';
    public bool $sortAsc = true;

    public function resetFilters() { $this->reset(['search', 'openFilter', 'building_id', 'technician_id', ]); $this->resetPage(); }

    public function render()
    {
        abort_if_cannot('view_maintenance_requests');
        $query = (new MaintenanceRequestListQuery())->handle(['search' => $this->search,             'building_id' => $this->building_id,
            'technician_id' => $this->technician_id,
], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.facility-management.maintenance-requests.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => MaintenanceRequest::sortable(),
            'buildings' => \App\Models\FacilityManagement\Building::pluck('name', 'id')->toArray(),
            'technicians' => \App\Models\FacilityManagement\Technician::pluck('name', 'id')->toArray(),
        ])->layout('components.layouts.app');
    }

    public function sortBy($field) { if (!in_array($field, MaintenanceRequest::sortable(), true)) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deleteMaintenanceRequest($id, DeleteMaintenanceRequestAction $action) 
    {
        abort_if_cannot('delete_maintenance_requests');
        $item = MaintenanceRequest::find($id);
        if (!$item) { $this->dispatch('toast', message: __('facility-management/maintenance-requests.not_found'), type: 'error'); return; }
        try { $action->execute($item); $this->dispatch('toast', message: __('facility-management/maintenance-requests.deleted'), type: 'success'); $this->resetPage(); } 
        catch (\Illuminate\Database\QueryException $e) { $this->dispatch('toast', message: __('facility-management/maintenance-requests.delete_error_referenced'), type: 'error'); }
        catch (\Exception $e) { $this->dispatch('toast', message: __('facility-management/maintenance-requests.delete_error'), type: 'error'); }
    }
}