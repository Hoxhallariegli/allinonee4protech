<?php

namespace App\Livewire\Admin\SchoolManagement\Timetables;

use App\Models\SchoolManagement\Timetable;
use App\Domain\SchoolManagement\Timetable\Queries\TimetableListQuery;
use App\Domain\SchoolManagement\Timetable\Actions\DeleteTimetableAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Timetables')]
class Timetables extends Component
{
        use WithPagination;

    public int $paginate = 10;
    #[Url(history: true)] public string $search = '';
    #[Url(history: true)] public $school_class_id = '';
    #[Url(history: true)] public $subject_id = '';
    #[Url(history: true)] public $teacher_id = '';
    public bool $openFilter = false;
    public string $sortField = 'id';
    public bool $sortAsc = true;

    public function resetFilters() { $this->reset(['search', 'openFilter', 'school_class_id', 'subject_id', 'teacher_id', ]); $this->resetPage(); }

    public function render()
    {
        abort_if_cannot('view_timetables');
        $query = (new TimetableListQuery())->handle(['search' => $this->search,             'school_class_id' => $this->school_class_id,
            'subject_id' => $this->subject_id,
            'teacher_id' => $this->teacher_id,
], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.school-management.timetables.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => Timetable::sortable(),
            'schoolClasses' => \App\Models\SchoolManagement\SchoolClass::pluck('name', 'id')->toArray(),
            'subjects' => \App\Models\SchoolManagement\Subject::pluck('name', 'id')->toArray(),
            'teachers' => \App\Models\SchoolManagement\Teacher::pluck('name', 'id')->toArray(),
        ])->layout('components.layouts.app');
    }

    public function sortBy($field) { if (!in_array($field, Timetable::sortable(), true)) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deleteTimetable($id, DeleteTimetableAction $action) 
    {
        abort_if_cannot('delete_timetables');
        $item = Timetable::find($id);
        if (!$item) { $this->dispatch('toast', message: __('school-management/timetables.not_found'), type: 'error'); return; }
        try { $action->execute($item); $this->dispatch('toast', message: __('school-management/timetables.deleted'), type: 'success'); $this->resetPage(); } 
        catch (\Illuminate\Database\QueryException $e) { $this->dispatch('toast', message: __('school-management/timetables.delete_error_referenced'), type: 'error'); }
        catch (\Exception $e) { $this->dispatch('toast', message: __('school-management/timetables.delete_error'), type: 'error'); }
    }
}