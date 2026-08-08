<?php

namespace App\Livewire\Admin\ConstructionERP\Subcontractors;

use App\Models\ConstructionERP\Subcontractor;
use App\Domain\ConstructionERP\Subcontractor\Queries\SubcontractorListQuery;
use App\Domain\ConstructionERP\Subcontractor\Actions\DeleteSubcontractorAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Subcontractors')]
class Subcontractors extends Component
{
        use WithPagination;

    public int $paginate = 10;
    #[Url(history: true)] public string $search = '';
    #[Url(history: true)] public $project_id = '';
    public bool $openFilter = false;
    public string $sortField = 'id';
    public bool $sortAsc = true;

    public function resetFilters() { $this->reset(['search', 'openFilter', 'project_id', ]); $this->resetPage(); }

    public function render()
    {
        abort_if_cannot('view_subcontractors');
        $query = (new SubcontractorListQuery())->handle(['search' => $this->search,             'project_id' => $this->project_id,
], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.construction-e-r-p.subcontractors.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => Subcontractor::sortable(),
            'projects' => \App\Models\ConstructionERP\Project::pluck('name', 'id')->toArray(),
        ])->layout('components.layouts.app');
    }

    public function sortBy($field) { if (!in_array($field, Subcontractor::sortable(), true)) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deleteSubcontractor($id, DeleteSubcontractorAction $action) 
    {
        abort_if_cannot('delete_subcontractors');
        $item = Subcontractor::find($id);
        if (!$item) { $this->dispatch('toast', message: __('construction-e-r-p/subcontractors.not_found'), type: 'error'); return; }
        try { $action->execute($item); $this->dispatch('toast', message: __('construction-e-r-p/subcontractors.deleted'), type: 'success'); $this->resetPage(); } 
        catch (\Illuminate\Database\QueryException $e) { $this->dispatch('toast', message: __('construction-e-r-p/subcontractors.delete_error_referenced'), type: 'error'); }
        catch (\Exception $e) { $this->dispatch('toast', message: __('construction-e-r-p/subcontractors.delete_error'), type: 'error'); }
    }
}