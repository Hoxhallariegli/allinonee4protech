<?php

namespace App\Livewire\Admin\HumanResources\Attendances;

use App\Models\HumanResources\Attendance;
use App\Domain\HumanResources\Attendance\Queries\AttendanceListQuery;
use App\Domain\HumanResources\Attendance\Actions\DeleteAttendanceAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Attendances')]
class Attendances extends Component
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
        abort_if_cannot('view_attendances');
        $query = (new AttendanceListQuery())->handle(['search' => $this->search,             'employee_id' => $this->employee_id,
], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.human-resources.attendances.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => Attendance::sortable(),
            'employees' => \App\Models\HumanResources\Employee::pluck('name', 'id')->toArray(),
        ])->layout('components.layouts.app');
    }

    public function sortBy($field) { if (!in_array($field, Attendance::sortable(), true)) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deleteAttendance($id, DeleteAttendanceAction $action) 
    {
        abort_if_cannot('delete_attendances');
        $item = Attendance::find($id);
        if (!$item) { $this->dispatch('toast', message: __('human-resources/attendances.not_found'), type: 'error'); return; }
        try { $action->execute($item); $this->dispatch('toast', message: __('human-resources/attendances.deleted'), type: 'success'); $this->resetPage(); } 
        catch (\Illuminate\Database\QueryException $e) { $this->dispatch('toast', message: __('human-resources/attendances.delete_error_referenced'), type: 'error'); }
        catch (\Exception $e) { $this->dispatch('toast', message: __('human-resources/attendances.delete_error'), type: 'error'); }
    }
}