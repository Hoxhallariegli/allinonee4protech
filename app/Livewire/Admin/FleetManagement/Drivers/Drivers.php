<?php

namespace App\Livewire\Admin\FleetManagement\Drivers;

use App\Models\FleetManagement\Driver;
use App\Domain\FleetManagement\Driver\Queries\DriverListQuery;
use App\Domain\FleetManagement\Driver\Actions\DeleteDriverAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;

#[Title('Drivers')]
class Drivers extends Component
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
        abort_if_cannot('view_drivers');
        $query = (new DriverListQuery())->handle(['search' => $this->search, ], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.fleet-management.drivers.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => Driver::sortable(),
        ])->layout('components.layouts.app');
    }

    public function sortBy($field) { if (!in_array($field, Driver::sortable(), true)) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deleteDriver($id, DeleteDriverAction $action) 
    {
        abort_if_cannot('delete_drivers');
        $item = Driver::find($id);
        if (!$item) { $this->dispatch('toast', message: __('fleet-management/drivers.not_found'), type: 'error'); return; }
        try { $action->execute($item); $this->dispatch('toast', message: __('fleet-management/drivers.deleted'), type: 'success'); $this->resetPage(); } 
        catch (\Illuminate\Database\QueryException $e) { $this->dispatch('toast', message: __('fleet-management/drivers.delete_error_referenced'), type: 'error'); }
        catch (\Exception $e) { $this->dispatch('toast', message: __('fleet-management/drivers.delete_error'), type: 'error'); }
    }
}