<?php

namespace App\Livewire\Admin\Finance\Accounts;

use App\Models\Finance\Account;
use App\Domain\Finance\Account\Queries\AccountListQuery;
use App\Domain\Finance\Account\Actions\DeleteAccountAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Accounts')]
class Accounts extends Component
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
        abort_if_cannot('view_accounts');
        $query = (new AccountListQuery())->handle(['search' => $this->search, ], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.finance.accounts.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => Account::sortable(),
        ])->layout('components.layouts.app');
    }

    public function sortBy($field) { if (!in_array($field, Account::sortable(), true)) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deleteAccount($id, DeleteAccountAction $action) 
    {
        abort_if_cannot('delete_accounts');
        $item = Account::find($id);
        if (!$item) { $this->dispatch('toast', message: __('finance/accounts.not_found'), type: 'error'); return; }
        try { $action->execute($item); $this->dispatch('toast', message: __('finance/accounts.deleted'), type: 'success'); $this->resetPage(); } 
        catch (\Illuminate\Database\QueryException $e) { $this->dispatch('toast', message: __('finance/accounts.delete_error_referenced'), type: 'error'); }
        catch (\Exception $e) { $this->dispatch('toast', message: __('finance/accounts.delete_error'), type: 'error'); }
    }
}