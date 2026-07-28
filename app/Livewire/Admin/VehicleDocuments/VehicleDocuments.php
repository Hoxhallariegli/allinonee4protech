<?php

namespace App\Livewire\Admin\VehicleDocuments;

use App\Models\VehicleDocument;
use App\Domain\VehicleDocument\Queries\VehicleDocumentListQuery;
use App\Domain\VehicleDocument\Actions\DeleteVehicleDocumentAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;

#[Title('VehicleDocuments')]
class VehicleDocuments extends Component
{
        use WithPagination, WithFileUploads;

    public int $paginate = 10;
    #[Url(history: true)] public string $search = '';
    #[Url(history: true)] public $vehicle_id = '';
    public bool $openFilter = false;
    public string $sortField = 'id';
    public bool $sortAsc = true;

    public function resetFilters() { $this->reset(['search', 'openFilter', 'vehicle_id', ]); $this->resetPage(); }

    public function render()
    {
        abort_if_cannot('view_vehicle_documents');
        $query = (new VehicleDocumentListQuery())->handle(['search' => $this->search,             'vehicle_id' => $this->vehicle_id,
], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.vehicle-documents.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => VehicleDocument::sortable(),
            'vehicles' => \App\Models\Vehicle::pluck('license_plate', 'id')->toArray(),
        ])->layout('components.layouts.app');
    }

    public function sortBy($field) { if (!in_array($field, VehicleDocument::sortable(), true)) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deleteVehicleDocument($id, DeleteVehicleDocumentAction $action) 
    {
        abort_if_cannot('delete_vehicle_documents');
        $item = VehicleDocument::find($id);
        if (!$item) { $this->dispatch('toast', message: __('vehicle-documents.not_found'), type: 'error'); return; }
        try { $action->execute($item); $this->dispatch('toast', message: __('vehicle-documents.deleted'), type: 'success'); $this->resetPage(); } 
        catch (\Illuminate\Database\QueryException $e) { $this->dispatch('toast', message: __('vehicle-documents.delete_error_referenced'), type: 'error'); }
        catch (\Exception $e) { $this->dispatch('toast', message: __('vehicle-documents.delete_error'), type: 'error'); }
    }
}