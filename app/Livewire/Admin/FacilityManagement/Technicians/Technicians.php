<?php

namespace App\Livewire\Admin\FacilityManagement\Technicians;

use App\Models\FacilityManagement\Technician;
use App\Domain\FacilityManagement\Technician\Queries\TechnicianListQuery;
use App\Domain\FacilityManagement\Technician\Actions\DeleteTechnicianAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Technicians')]
class Technicians extends Component
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
        abort_if_cannot('view_technicians');
        $query = (new TechnicianListQuery())->handle(['search' => $this->search, ], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.facility-management.technicians.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => Technician::sortable(),
        ])->layout('components.layouts.app');
    }

    public function sortBy($field) { if (!in_array($field, Technician::sortable(), true)) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deleteTechnician($id, DeleteTechnicianAction $action) 
    {
        abort_if_cannot('delete_technicians');
        $item = Technician::find($id);
        if (!$item) { $this->dispatch('toast', message: __('facility-management/technicians.not_found'), type: 'error'); return; }
        try { $action->execute($item); $this->dispatch('toast', message: __('facility-management/technicians.deleted'), type: 'success'); $this->resetPage(); } 
        catch (\Illuminate\Database\QueryException $e) { $this->dispatch('toast', message: __('facility-management/technicians.delete_error_referenced'), type: 'error'); }
        catch (\Exception $e) { $this->dispatch('toast', message: __('facility-management/technicians.delete_error'), type: 'error'); }
    }
}