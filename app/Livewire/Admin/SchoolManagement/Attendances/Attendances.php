<?php

namespace App\Livewire\Admin\SchoolManagement\Attendances;

use App\Models\SchoolManagement\Attendance;
use App\Domain\SchoolManagement\Attendance\Queries\AttendanceListQuery;
use App\Domain\SchoolManagement\Attendance\Actions\DeleteAttendanceAction;
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
    #[Url(history: true)] public $student_id = '';
    #[Url(history: true)] public $class_id = '';
    public bool $openFilter = false;
    public string $sortField = 'id';
    public bool $sortAsc = true;

    public function resetFilters() { $this->reset(['search', 'openFilter', 'student_id', 'class_id', ]); $this->resetPage(); }

    public function render()
    {
        abort_if_cannot('view_attendances');
        $query = (new AttendanceListQuery())->handle(['search' => $this->search,             'student_id' => $this->student_id,
            'class_id' => $this->class_id,
], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.school-management.attendances.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => Attendance::sortable(),
            'students' => \App\Models\SchoolManagement\Student::pluck('name', 'id')->toArray(),
            'classes' => \App\Models\SchoolManagement\SchoolClass::pluck('name', 'id')->toArray(),
        ])->layout('components.layouts.app');
    }

    public function sortBy($field) { if (!in_array($field, Attendance::sortable(), true)) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deleteAttendance($id, DeleteAttendanceAction $action) 
    {
        abort_if_cannot('delete_attendances');
        $item = Attendance::find($id);
        if (!$item) { $this->dispatch('toast', message: __('school-management/attendances.not_found'), type: 'error'); return; }
        try { $action->execute($item); $this->dispatch('toast', message: __('school-management/attendances.deleted'), type: 'success'); $this->resetPage(); } 
        catch (\Illuminate\Database\QueryException $e) { $this->dispatch('toast', message: __('school-management/attendances.delete_error_referenced'), type: 'error'); }
        catch (\Exception $e) { $this->dispatch('toast', message: __('school-management/attendances.delete_error'), type: 'error'); }
    }
}