<?php

namespace App\Livewire\Admin\CRM\Tasks;

use App\Models\CRM\Task;
use App\Domain\CRM\Task\Queries\TaskListQuery;
use App\Domain\CRM\Task\Actions\DeleteTaskAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Tasks')]
class Tasks extends Component
{
        use WithPagination;

    public int $paginate = 10;
    #[Url(history: true)] public string $search = '';
    #[Url(history: true)] public $deal_id = '';
    public bool $openFilter = false;
    public string $sortField = 'id';
    public bool $sortAsc = true;

    public function resetFilters() { $this->reset(['search', 'openFilter', 'deal_id', ]); $this->resetPage(); }

    public function render()
    {
        abort_if_cannot('view_tasks');
        $query = (new TaskListQuery())->handle(['search' => $this->search,             'deal_id' => $this->deal_id,
], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.c-r-m.tasks.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => Task::sortable(),
            'deals' => \App\Models\CRM\Deal::pluck('name', 'id')->toArray(),
        ])->layout('components.layouts.app');
    }

    public function sortBy($field) { if (!in_array($field, Task::sortable(), true)) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deleteTask($id, DeleteTaskAction $action) 
    {
        abort_if_cannot('delete_tasks');
        $item = Task::find($id);
        if (!$item) { $this->dispatch('toast', message: __('c-r-m/tasks.not_found'), type: 'error'); return; }
        try { $action->execute($item); $this->dispatch('toast', message: __('c-r-m/tasks.deleted'), type: 'success'); $this->resetPage(); } 
        catch (\Illuminate\Database\QueryException $e) { $this->dispatch('toast', message: __('c-r-m/tasks.delete_error_referenced'), type: 'error'); }
        catch (\Exception $e) { $this->dispatch('toast', message: __('c-r-m/tasks.delete_error'), type: 'error'); }
    }
}