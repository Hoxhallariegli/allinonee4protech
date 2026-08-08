<?php

namespace App\Livewire\Admin\RealEstateCRM\Agents;

use App\Models\RealEstateCRM\Agent;
use App\Domain\RealEstateCRM\Agent\Queries\AgentListQuery;
use App\Domain\RealEstateCRM\Agent\Actions\DeleteAgentAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;

#[Title('Agents')]
class Agents extends Component
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
        abort_if_cannot('view_agents');
        $query = (new AgentListQuery())->handle(['search' => $this->search, ], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.real-estate-c-r-m.agents.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => Agent::sortable(),
        ])->layout('components.layouts.app');
    }

    public function sortBy($field) { if (!in_array($field, Agent::sortable(), true)) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deleteAgent($id, DeleteAgentAction $action) 
    {
        abort_if_cannot('delete_agents');
        $item = Agent::find($id);
        if (!$item) { $this->dispatch('toast', message: __('real-estate-c-r-m/agents.not_found'), type: 'error'); return; }
        try { $action->execute($item); $this->dispatch('toast', message: __('real-estate-c-r-m/agents.deleted'), type: 'success'); $this->resetPage(); } 
        catch (\Illuminate\Database\QueryException $e) { $this->dispatch('toast', message: __('real-estate-c-r-m/agents.delete_error_referenced'), type: 'error'); }
        catch (\Exception $e) { $this->dispatch('toast', message: __('real-estate-c-r-m/agents.delete_error'), type: 'error'); }
    }
}