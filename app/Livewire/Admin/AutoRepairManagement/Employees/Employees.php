<?php

namespace App\Livewire\Admin\AutoRepairManagement\Employees;

use App\Models\AutoRepairManagement\Employee;
use App\Domain\AutoRepairManagement\Employee\Queries\EmployeeListQuery;
use App\Domain\AutoRepairManagement\Employee\Actions\DeleteEmployeeAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Employees')]
class Employees extends Component
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
        abort_if_cannot('view_employees');
        $query = (new EmployeeListQuery())->handle(['search' => $this->search, ], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.auto-repair-management.employees.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => Employee::sortable(),
        ])->layout('components.layouts.app');
    }

    public function sortBy($field) { if (!in_array($field, Employee::sortable(), true)) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deleteEmployee($id, DeleteEmployeeAction $action) 
    {
        abort_if_cannot('delete_employees');
        $item = Employee::find($id);
        if (!$item) { $this->dispatch('toast', message: __('auto-repair-management/employees.not_found'), type: 'error'); return; }
        try { $action->execute($item); $this->dispatch('toast', message: __('auto-repair-management/employees.deleted'), type: 'success'); $this->resetPage(); } 
        catch (\Illuminate\Database\QueryException $e) { $this->dispatch('toast', message: __('auto-repair-management/employees.delete_error_referenced'), type: 'error'); }
        catch (\Exception $e) { $this->dispatch('toast', message: __('auto-repair-management/employees.delete_error'), type: 'error'); }
    }
}