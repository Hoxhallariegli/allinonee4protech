<?php

namespace App\Livewire\Admin\AutoRepairManagement\Mechanics;

use App\Models\AutoRepairManagement\Mechanic;
use App\Domain\AutoRepairManagement\Mechanic\Queries\MechanicListQuery;
use App\Domain\AutoRepairManagement\Mechanic\Actions\DeleteMechanicAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Mechanics')]
class Mechanics extends Component
{
        use WithPagination;

    public int $paginate = 10;
    #[Url(history: true)] public string $search = '';
    #[Url(history: true)] public $employee_id = '';
    public bool $openFilter = false;
    public string $sortField = 'id';
    public bool $sortAsc = true;

    public function resetFilters() { $this->reset(['search', 'openFilter', 'employee_id', ]); $this->resetPage(); }

    public function render()
    {
        abort_if_cannot('view_mechanics');
        $query = (new MechanicListQuery())->handle(['search' => $this->search,             'employee_id' => $this->employee_id,
], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.auto-repair-management.mechanics.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => Mechanic::sortable(),
            'employees' => \App\Models\AutoRepairManagement\Employee::pluck('name', 'id')->toArray(),
        ])->layout('components.layouts.app');
    }

    public function sortBy($field) { if (!in_array($field, Mechanic::sortable(), true)) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deleteMechanic($id, DeleteMechanicAction $action) 
    {
        abort_if_cannot('delete_mechanics');
        $item = Mechanic::find($id);
        if (!$item) { $this->dispatch('toast', message: __('auto-repair-management/mechanics.not_found'), type: 'error'); return; }
        try { $action->execute($item); $this->dispatch('toast', message: __('auto-repair-management/mechanics.deleted'), type: 'success'); $this->resetPage(); } 
        catch (\Illuminate\Database\QueryException $e) { $this->dispatch('toast', message: __('auto-repair-management/mechanics.delete_error_referenced'), type: 'error'); }
        catch (\Exception $e) { $this->dispatch('toast', message: __('auto-repair-management/mechanics.delete_error'), type: 'error'); }
    }
}