<?php

namespace App\Livewire\Admin\Finance\Expenses;

use App\Models\Finance\Expense;
use App\Domain\Finance\Expense\Queries\ExpenseListQuery;
use App\Domain\Finance\Expense\Actions\DeleteExpenseAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;

#[Title('Expenses')]
class Expenses extends Component
{
        use WithPagination, WithFileUploads;

    public int $paginate = 10;
    #[Url(history: true)] public string $search = '';
    #[Url(history: true)] public $category_id = '';
    public bool $openFilter = false;
    public string $sortField = 'id';
    public bool $sortAsc = true;

    public function resetFilters() { $this->reset(['search', 'openFilter', 'category_id', ]); $this->resetPage(); }

    public function render()
    {
        abort_if_cannot('view_expenses');
        $query = (new ExpenseListQuery())->handle(['search' => $this->search,             'category_id' => $this->category_id,
], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.finance.expenses.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => Expense::sortable(),
            'categories' => \App\Models\Finance\Category::pluck('name', 'id')->toArray(),
        ])->layout('components.layouts.app');
    }

    public function sortBy($field) { if (!in_array($field, Expense::sortable(), true)) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deleteExpense($id, DeleteExpenseAction $action) 
    {
        abort_if_cannot('delete_expenses');
        $item = Expense::find($id);
        if (!$item) { $this->dispatch('toast', message: __('finance/expenses.not_found'), type: 'error'); return; }
        try { $action->execute($item); $this->dispatch('toast', message: __('finance/expenses.deleted'), type: 'success'); $this->resetPage(); } 
        catch (\Illuminate\Database\QueryException $e) { $this->dispatch('toast', message: __('finance/expenses.delete_error_referenced'), type: 'error'); }
        catch (\Exception $e) { $this->dispatch('toast', message: __('finance/expenses.delete_error'), type: 'error'); }
    }
}