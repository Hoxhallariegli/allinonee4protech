<?php

namespace App\Livewire\Admin\ConstructionERP\Projects;

use App\Models\ConstructionERP\Project;
use App\Domain\ConstructionERP\Project\Queries\ProjectListQuery;
use App\Domain\ConstructionERP\Project\Actions\DeleteProjectAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Projects')]
class Projects extends Component
{
        use WithPagination;

    public int $paginate = 10;
    #[Url(history: true)] public string $search = '';
    #[Url(history: true)] public $client_id = '';
    public bool $openFilter = false;
    public string $sortField = 'id';
    public bool $sortAsc = true;

    public function resetFilters() { $this->reset(['search', 'openFilter', 'client_id', ]); $this->resetPage(); }

    public function render()
    {
        abort_if_cannot('view_projects');
        $query = (new ProjectListQuery())->handle(['search' => $this->search,             'client_id' => $this->client_id,
], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.construction-e-r-p.projects.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => Project::sortable(),
            'clients' => \App\Models\ConstructionERP\Client::pluck('name', 'id')->toArray(),
        ])->layout('components.layouts.app');
    }

    public function sortBy($field) { if (!in_array($field, Project::sortable(), true)) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deleteProject($id, DeleteProjectAction $action) 
    {
        abort_if_cannot('delete_projects');
        $item = Project::find($id);
        if (!$item) { $this->dispatch('toast', message: __('construction-e-r-p/projects.not_found'), type: 'error'); return; }
        try { $action->execute($item); $this->dispatch('toast', message: __('construction-e-r-p/projects.deleted'), type: 'success'); $this->resetPage(); } 
        catch (\Illuminate\Database\QueryException $e) { $this->dispatch('toast', message: __('construction-e-r-p/projects.delete_error_referenced'), type: 'error'); }
        catch (\Exception $e) { $this->dispatch('toast', message: __('construction-e-r-p/projects.delete_error'), type: 'error'); }
    }
}