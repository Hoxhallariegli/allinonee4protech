<?php

namespace App\Livewire\Admin\SchoolManagement\SchoolClasses;

use App\Models\SchoolManagement\SchoolClass;
use App\Domain\SchoolManagement\SchoolClass\Queries\SchoolClassListQuery;
use App\Domain\SchoolManagement\SchoolClass\Actions\DeleteSchoolClassAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('SchoolClasses')]
class SchoolClasses extends Component
{
        use WithPagination;

    public int $paginate = 10;
    #[Url(history: true)] public string $search = '';
    #[Url(history: true)] public $teacher_id = '';
    public bool $openFilter = false;
    public string $sortField = 'id';
    public bool $sortAsc = true;

    public function resetFilters() { $this->reset(['search', 'openFilter', 'teacher_id', ]); $this->resetPage(); }

    public function render()
    {
        abort_if_cannot('view_school_classes');
        $query = (new SchoolClassListQuery())->handle(['search' => $this->search,             'teacher_id' => $this->teacher_id,
], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.school-management.school-classes.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => SchoolClass::sortable(),
            'teachers' => \App\Models\SchoolManagement\Teacher::pluck('name', 'id')->toArray(),
        ])->layout('components.layouts.app');
    }

    public function sortBy($field) { if (!in_array($field, SchoolClass::sortable(), true)) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deleteSchoolClass($id, DeleteSchoolClassAction $action) 
    {
        abort_if_cannot('delete_school_classes');
        $item = SchoolClass::find($id);
        if (!$item) { $this->dispatch('toast', message: __('school-management/school-classes.not_found'), type: 'error'); return; }
        try { $action->execute($item); $this->dispatch('toast', message: __('school-management/school-classes.deleted'), type: 'success'); $this->resetPage(); } 
        catch (\Illuminate\Database\QueryException $e) { $this->dispatch('toast', message: __('school-management/school-classes.delete_error_referenced'), type: 'error'); }
        catch (\Exception $e) { $this->dispatch('toast', message: __('school-management/school-classes.delete_error'), type: 'error'); }
    }
}