<?php

namespace App\Livewire\Admin\HumanResources\Departments;

use App\Models\HumanResources\Department;
use App\Domain\HumanResources\Department\Queries\DepartmentListQuery;
use App\Domain\HumanResources\Department\Actions\DeleteDepartmentAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Departments')]
class Departments extends Component
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
        abort_if_cannot('view_departments');
        $query = (new DepartmentListQuery())->handle(['search' => $this->search, ], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.human-resources.departments.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => Department::sortable(),
        ])->layout('components.layouts.app');
    }

    public function sortBy($field) { if (!in_array($field, Department::sortable(), true)) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deleteDepartment($id, DeleteDepartmentAction $action) 
    {
        abort_if_cannot('delete_departments');
        $item = Department::find($id);
        if (!$item) { $this->dispatch('toast', message: __('human-resources/departments.not_found'), type: 'error'); return; }
        try { $action->execute($item); $this->dispatch('toast', message: __('human-resources/departments.deleted'), type: 'success'); $this->resetPage(); } 
        catch (\Illuminate\Database\QueryException $e) { $this->dispatch('toast', message: __('human-resources/departments.delete_error_referenced'), type: 'error'); }
        catch (\Exception $e) { $this->dispatch('toast', message: __('human-resources/departments.delete_error'), type: 'error'); }
    }
}