<?php

namespace App\Livewire\Admin\SchoolManagement\Assignments;

use App\Models\SchoolManagement\Assignment;
use App\Domain\SchoolManagement\Assignment\Queries\AssignmentListQuery;
use App\Domain\SchoolManagement\Assignment\Actions\DeleteAssignmentAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Assignments')]
class Assignments extends Component
{
        use WithPagination;

    public int $paginate = 10;
    #[Url(history: true)] public string $search = '';
    #[Url(history: true)] public $school_class_id = '';
    #[Url(history: true)] public $subject_id = '';
    public bool $openFilter = false;
    public string $sortField = 'id';
    public bool $sortAsc = true;

    public function resetFilters() { $this->reset(['search', 'openFilter', 'school_class_id', 'subject_id', ]); $this->resetPage(); }

    public function render()
    {
        abort_if_cannot('view_assignments');
        $query = (new AssignmentListQuery())->handle(['search' => $this->search,             'school_class_id' => $this->school_class_id,
            'subject_id' => $this->subject_id,
], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.school-management.assignments.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => Assignment::sortable(),
            'schoolClasses' => \App\Models\SchoolManagement\SchoolClass::pluck('name', 'id')->toArray(),
            'subjects' => \App\Models\SchoolManagement\Subject::pluck('name', 'id')->toArray(),
        ])->layout('components.layouts.app');
    }

    public function sortBy($field) { if (!in_array($field, Assignment::sortable(), true)) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deleteAssignment($id, DeleteAssignmentAction $action) 
    {
        abort_if_cannot('delete_assignments');
        $item = Assignment::find($id);
        if (!$item) { $this->dispatch('toast', message: __('school-management/assignments.not_found'), type: 'error'); return; }
        try { $action->execute($item); $this->dispatch('toast', message: __('school-management/assignments.deleted'), type: 'success'); $this->resetPage(); } 
        catch (\Illuminate\Database\QueryException $e) { $this->dispatch('toast', message: __('school-management/assignments.delete_error_referenced'), type: 'error'); }
        catch (\Exception $e) { $this->dispatch('toast', message: __('school-management/assignments.delete_error'), type: 'error'); }
    }
}