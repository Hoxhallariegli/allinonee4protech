<?php

namespace App\Livewire\Admin\SchoolManagement\Students;

use App\Models\SchoolManagement\Student;
use App\Domain\SchoolManagement\Student\Queries\StudentListQuery;
use App\Domain\SchoolManagement\Student\Actions\DeleteStudentAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;

#[Title('Students')]
class Students extends Component
{
        use WithPagination, WithFileUploads;

    public int $paginate = 10;
    #[Url(history: true)] public string $search = '';
    #[Url(history: true)] public $guardian_id = '';
    #[Url(history: true)] public $class_id = '';
    public bool $openFilter = false;
    public string $sortField = 'id';
    public bool $sortAsc = true;

    public function resetFilters() { $this->reset(['search', 'openFilter', 'guardian_id', 'class_id', ]); $this->resetPage(); }

    public function render()
    {
        abort_if_cannot('view_students');
        $query = (new StudentListQuery())->handle(['search' => $this->search,             'guardian_id' => $this->guardian_id,
            'class_id' => $this->class_id,
], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.school-management.students.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => Student::sortable(),
            'guardians' => \App\Models\SchoolManagement\Guardian::pluck('name', 'id')->toArray(),
            'classes' => \App\Models\SchoolManagement\SchoolClass::pluck('name', 'id')->toArray(),
        ])->layout('components.layouts.app');
    }

    public function sortBy($field) { if (!in_array($field, Student::sortable(), true)) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deleteStudent($id, DeleteStudentAction $action) 
    {
        abort_if_cannot('delete_students');
        $item = Student::find($id);
        if (!$item) { $this->dispatch('toast', message: __('school-management/students.not_found'), type: 'error'); return; }
        try { $action->execute($item); $this->dispatch('toast', message: __('school-management/students.deleted'), type: 'success'); $this->resetPage(); } 
        catch (\Illuminate\Database\QueryException $e) { $this->dispatch('toast', message: __('school-management/students.delete_error_referenced'), type: 'error'); }
        catch (\Exception $e) { $this->dispatch('toast', message: __('school-management/students.delete_error'), type: 'error'); }
    }
}