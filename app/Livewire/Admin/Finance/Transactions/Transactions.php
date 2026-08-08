<?php

namespace App\Livewire\Admin\Finance\Transactions;

use App\Models\Finance\Transaction;
use App\Domain\Finance\Transaction\Queries\TransactionListQuery;
use App\Domain\Finance\Transaction\Actions\DeleteTransactionAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Transactions')]
class Transactions extends Component
{
        use WithPagination;

    public int $paginate = 10;
    #[Url(history: true)] public string $search = '';
    #[Url(history: true)] public $account_id = '';
    #[Url(history: true)] public $category_id = '';
    public bool $openFilter = false;
    public string $sortField = 'id';
    public bool $sortAsc = true;

    public function resetFilters() { $this->reset(['search', 'openFilter', 'account_id', 'category_id', ]); $this->resetPage(); }

    public function render()
    {
        abort_if_cannot('view_transactions');
        $query = (new TransactionListQuery())->handle(['search' => $this->search,             'account_id' => $this->account_id,
            'category_id' => $this->category_id,
], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.finance.transactions.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => Transaction::sortable(),
            'accounts' => \App\Models\Finance\Account::pluck('name', 'id')->toArray(),
            'categories' => \App\Models\Finance\Category::pluck('name', 'id')->toArray(),
        ])->layout('components.layouts.app');
    }

    public function sortBy($field) { if (!in_array($field, Transaction::sortable(), true)) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deleteTransaction($id, DeleteTransactionAction $action) 
    {
        abort_if_cannot('delete_transactions');
        $item = Transaction::find($id);
        if (!$item) { $this->dispatch('toast', message: __('finance/transactions.not_found'), type: 'error'); return; }
        try { $action->execute($item); $this->dispatch('toast', message: __('finance/transactions.deleted'), type: 'success'); $this->resetPage(); } 
        catch (\Illuminate\Database\QueryException $e) { $this->dispatch('toast', message: __('finance/transactions.delete_error_referenced'), type: 'error'); }
        catch (\Exception $e) { $this->dispatch('toast', message: __('finance/transactions.delete_error'), type: 'error'); }
    }
}