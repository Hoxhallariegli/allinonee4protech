<?php

namespace App\Livewire\Admin\AutoRepairManagement\ExpenseTrackings;

use App\Models\AutoRepairManagement\ExpenseTracking;
use App\Domain\AutoRepairManagement\ExpenseTracking\Queries\ExpenseTrackingListQuery;
use App\Domain\AutoRepairManagement\ExpenseTracking\Actions\DeleteExpenseTrackingAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('ExpenseTrackings')]
class ExpenseTrackings extends Component
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
        abort_if_cannot('view_expense_trackings');
        $query = (new ExpenseTrackingListQuery())->handle(['search' => $this->search, ], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.auto-repair-management.expense-trackings.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => ExpenseTracking::sortable(),
        ])->layout('components.layouts.app');
    }

    public function sortBy($field) { if (!in_array($field, ExpenseTracking::sortable(), true)) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deleteExpenseTracking($id, DeleteExpenseTrackingAction $action) 
    {
        abort_if_cannot('delete_expense_trackings');
        $item = ExpenseTracking::find($id);
        if (!$item) { $this->dispatch('toast', message: __('auto-repair-management/expense-trackings.not_found'), type: 'error'); return; }
        try { $action->execute($item); $this->dispatch('toast', message: __('auto-repair-management/expense-trackings.deleted'), type: 'success'); $this->resetPage(); } 
        catch (\Illuminate\Database\QueryException $e) { $this->dispatch('toast', message: __('auto-repair-management/expense-trackings.delete_error_referenced'), type: 'error'); }
        catch (\Exception $e) { $this->dispatch('toast', message: __('auto-repair-management/expense-trackings.delete_error'), type: 'error'); }
    }
}