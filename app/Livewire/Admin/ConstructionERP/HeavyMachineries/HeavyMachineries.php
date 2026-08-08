<?php

namespace App\Livewire\Admin\ConstructionERP\HeavyMachineries;

use App\Models\ConstructionERP\HeavyMachinery;
use App\Domain\ConstructionERP\HeavyMachinery\Queries\HeavyMachineryListQuery;
use App\Domain\ConstructionERP\HeavyMachinery\Actions\DeleteHeavyMachineryAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('HeavyMachineries')]
class HeavyMachineries extends Component
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
        abort_if_cannot('view_heavy_machineries');
        $query = (new HeavyMachineryListQuery())->handle(['search' => $this->search,             'project_id' => $this->project_id,
], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.construction-e-r-p.heavy-machineries.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => HeavyMachinery::sortable(),
            'projects' => \App\Models\ConstructionERP\Project::pluck('name', 'id')->toArray(),
        ])->layout('components.layouts.app');
    }

    public function sortBy($field) { if (!in_array($field, HeavyMachinery::sortable(), true)) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deleteHeavyMachinery($id, DeleteHeavyMachineryAction $action) 
    {
        abort_if_cannot('delete_heavy_machineries');
        $item = HeavyMachinery::find($id);
        if (!$item) { $this->dispatch('toast', message: __('construction-e-r-p/heavy-machineries.not_found'), type: 'error'); return; }
        try { $action->execute($item); $this->dispatch('toast', message: __('construction-e-r-p/heavy-machineries.deleted'), type: 'success'); $this->resetPage(); } 
        catch (\Illuminate\Database\QueryException $e) { $this->dispatch('toast', message: __('construction-e-r-p/heavy-machineries.delete_error_referenced'), type: 'error'); }
        catch (\Exception $e) { $this->dispatch('toast', message: __('construction-e-r-p/heavy-machineries.delete_error'), type: 'error'); }
    }
}