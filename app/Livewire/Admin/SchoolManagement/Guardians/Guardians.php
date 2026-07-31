<?php

namespace App\Livewire\Admin\SchoolManagement\Guardians;

use App\Models\SchoolManagement\Guardian;
use App\Domain\SchoolManagement\Guardian\Queries\GuardianListQuery;
use App\Domain\SchoolManagement\Guardian\Actions\DeleteGuardianAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Guardians')]
class Guardians extends Component
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
        abort_if_cannot('view_guardians');
        $query = (new GuardianListQuery())->handle(['search' => $this->search, ], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.school-management.guardians.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => Guardian::sortable(),
        ])->layout('components.layouts.app');
    }

    public function sortBy($field) { if (!in_array($field, Guardian::sortable(), true)) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deleteGuardian($id, DeleteGuardianAction $action) 
    {
        abort_if_cannot('delete_guardians');
        $item = Guardian::find($id);
        if (!$item) { $this->dispatch('toast', message: __('school-management/guardians.not_found'), type: 'error'); return; }
        try { $action->execute($item); $this->dispatch('toast', message: __('school-management/guardians.deleted'), type: 'success'); $this->resetPage(); } 
        catch (\Illuminate\Database\QueryException $e) { $this->dispatch('toast', message: __('school-management/guardians.delete_error_referenced'), type: 'error'); }
        catch (\Exception $e) { $this->dispatch('toast', message: __('school-management/guardians.delete_error'), type: 'error'); }
    }
}