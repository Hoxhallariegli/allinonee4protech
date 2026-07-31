<?php

namespace App\Livewire\Admin\SchoolManagement\Grades;

use App\Models\SchoolManagement\Grade;
use App\Domain\SchoolManagement\Grade\Queries\GradeListQuery;
use App\Domain\SchoolManagement\Grade\Actions\DeleteGradeAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Grades')]
class Grades extends Component
{
        use WithPagination;

    public int $paginate = 10;
    #[Url(history: true)] public string $search = '';
    #[Url(history: true)] public $student_id = '';
    #[Url(history: true)] public $exam_id = '';
    public bool $openFilter = false;
    public string $sortField = 'id';
    public bool $sortAsc = true;

    public function resetFilters() { $this->reset(['search', 'openFilter', 'student_id', 'exam_id', ]); $this->resetPage(); }

    public function render()
    {
        abort_if_cannot('view_grades');
        $query = (new GradeListQuery())->handle(['search' => $this->search,             'student_id' => $this->student_id,
            'exam_id' => $this->exam_id,
], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.school-management.grades.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => Grade::sortable(),
            'students' => \App\Models\SchoolManagement\Student::pluck('name', 'id')->toArray(),
            'exams' => \App\Models\SchoolManagement\Exam::pluck('name', 'id')->toArray(),
        ])->layout('components.layouts.app');
    }

    public function sortBy($field) { if (!in_array($field, Grade::sortable(), true)) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deleteGrade($id, DeleteGradeAction $action) 
    {
        abort_if_cannot('delete_grades');
        $item = Grade::find($id);
        if (!$item) { $this->dispatch('toast', message: __('school-management/grades.not_found'), type: 'error'); return; }
        try { $action->execute($item); $this->dispatch('toast', message: __('school-management/grades.deleted'), type: 'success'); $this->resetPage(); } 
        catch (\Illuminate\Database\QueryException $e) { $this->dispatch('toast', message: __('school-management/grades.delete_error_referenced'), type: 'error'); }
        catch (\Exception $e) { $this->dispatch('toast', message: __('school-management/grades.delete_error'), type: 'error'); }
    }
}