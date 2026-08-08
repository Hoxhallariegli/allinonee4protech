<?php

namespace App\Livewire\Admin\SchoolManagement\Subjects;

use App\Models\SchoolManagement\Subject;
use App\Domain\SchoolManagement\Subject\Queries\SubjectListQuery;
use App\Domain\SchoolManagement\Subject\Actions\DeleteSubjectAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Subjects')]
class Subjects extends Component
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
        abort_if_cannot('view_subjects');
        $query = (new SubjectListQuery())->handle(['search' => $this->search, ], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.school-management.subjects.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => Subject::sortable(),
        ])->layout('components.layouts.app');
    }

    public function sortBy($field) { if (!in_array($field, Subject::sortable(), true)) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deleteSubject($id, DeleteSubjectAction $action) 
    {
        abort_if_cannot('delete_subjects');
        $item = Subject::find($id);
        if (!$item) { $this->dispatch('toast', message: __('school-management/subjects.not_found'), type: 'error'); return; }
        try { $action->execute($item); $this->dispatch('toast', message: __('school-management/subjects.deleted'), type: 'success'); $this->resetPage(); } 
        catch (\Illuminate\Database\QueryException $e) { $this->dispatch('toast', message: __('school-management/subjects.delete_error_referenced'), type: 'error'); }
        catch (\Exception $e) { $this->dispatch('toast', message: __('school-management/subjects.delete_error'), type: 'error'); }
    }
}