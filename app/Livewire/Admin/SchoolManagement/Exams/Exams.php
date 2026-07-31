<?php

namespace App\Livewire\Admin\SchoolManagement\Exams;

use App\Models\SchoolManagement\Exam;
use App\Domain\SchoolManagement\Exam\Queries\ExamListQuery;
use App\Domain\SchoolManagement\Exam\Actions\DeleteExamAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Exams')]
class Exams extends Component
{
        use WithPagination;

    public int $paginate = 10;
    #[Url(history: true)] public string $search = '';
    #[Url(history: true)] public $class_id = '';
    public bool $openFilter = false;
    public string $sortField = 'id';
    public bool $sortAsc = true;

    public function resetFilters() { $this->reset(['search', 'openFilter', 'class_id', ]); $this->resetPage(); }

    public function render()
    {
        abort_if_cannot('view_exams');
        $query = (new ExamListQuery())->handle(['search' => $this->search,             'class_id' => $this->class_id,
], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.school-management.exams.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => Exam::sortable(),
            'classes' => \App\Models\SchoolManagement\SchoolClass::pluck('name', 'id')->toArray(),
        ])->layout('components.layouts.app');
    }

    public function sortBy($field) { if (!in_array($field, Exam::sortable(), true)) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deleteExam($id, DeleteExamAction $action) 
    {
        abort_if_cannot('delete_exams');
        $item = Exam::find($id);
        if (!$item) { $this->dispatch('toast', message: __('school-management/exams.not_found'), type: 'error'); return; }
        try { $action->execute($item); $this->dispatch('toast', message: __('school-management/exams.deleted'), type: 'success'); $this->resetPage(); } 
        catch (\Illuminate\Database\QueryException $e) { $this->dispatch('toast', message: __('school-management/exams.delete_error_referenced'), type: 'error'); }
        catch (\Exception $e) { $this->dispatch('toast', message: __('school-management/exams.delete_error'), type: 'error'); }
    }
}