<?php

namespace App\Livewire\Admin\Finance\Budgets;

use App\Models\Finance\Budget;
use App\Domain\Finance\Budget\Queries\BudgetListQuery;
use App\Domain\Finance\Budget\Actions\DeleteBudgetAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Budgets')]
class Budgets extends Component
{
        use WithPagination;

    public int $paginate = 10;
    #[Url(history: true)] public string $search = '';
    #[Url(history: true)] public $category_id = '';
    public bool $openFilter = false;
    public string $sortField = 'id';
    public bool $sortAsc = true;

    public function resetFilters() { $this->reset(['search', 'openFilter', 'category_id', ]); $this->resetPage(); }

    public function render()
    {
        abort_if_cannot('view_budgets');
        $query = (new BudgetListQuery())->handle(['search' => $this->search,             'category_id' => $this->category_id,
], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.finance.budgets.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => Budget::sortable(),
            'categories' => \App\Models\Finance\Category::pluck('name', 'id')->toArray(),
        ])->layout('components.layouts.app');
    }

    public function sortBy($field) { if (!in_array($field, Budget::sortable(), true)) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deleteBudget($id, DeleteBudgetAction $action) 
    {
        abort_if_cannot('delete_budgets');
        $item = Budget::find($id);
        if (!$item) { $this->dispatch('toast', message: __('finance/budgets.not_found'), type: 'error'); return; }
        try { $action->execute($item); $this->dispatch('toast', message: __('finance/budgets.deleted'), type: 'success'); $this->resetPage(); } 
        catch (\Illuminate\Database\QueryException $e) { $this->dispatch('toast', message: __('finance/budgets.delete_error_referenced'), type: 'error'); }
        catch (\Exception $e) { $this->dispatch('toast', message: __('finance/budgets.delete_error'), type: 'error'); }
    }
}