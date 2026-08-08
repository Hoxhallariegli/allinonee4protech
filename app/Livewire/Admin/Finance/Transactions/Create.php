<?php

namespace App\Livewire\Admin\Finance\Transactions;

use App\Models\Finance\Transaction;
use App\Domain\Finance\Transaction\DTOs\TransactionDTO;
use App\Domain\Finance\Transaction\Actions\CreateTransactionAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Add Transaction')]
class Create extends Component
{
        use WithPagination;
     public $account_id = '';
    public $category_id = '';
    public $amount = '';
    public $date = '';
    public $description = '';
 
    #[On('account-created')] 
    public function refreshAccounts($id) { $this->account_id = $id; $this->updatedAccountId($id); }

    #[On('category-created')] 
    public function refreshCategories($id) { $this->category_id = $id; $this->updatedCategoryId($id); }
 
    public function updatedAccountId($value)
    {
        if (!$value) return;
        $related = \App\Models\Finance\Account::find($value);
        if (!$related) return;
    }

    public function updatedCategoryId($value)
    {
        if (!$value) return;
        $related = \App\Models\Finance\Category::find($value);
        if (!$related) return;
    }
 
    protected function getaccountsList() {
        return \App\Models\Finance\Account::pluck('name', 'id')->toArray();
    }

    protected function getcategoriesList() {
        return \App\Models\Finance\Category::pluck('name', 'id')->toArray();
    }

    public function render() {
        abort_if_cannot('add_transactions');
        return view('livewire.admin.finance.transactions.create', [
            'accounts' => $this->getaccountsList(),
            'categories' => $this->getcategoriesList(),
        ])->layout('components.layouts.app');
    }
    public function store(CreateTransactionAction $action) { $this->validate();  $dto = TransactionDTO::fromArray([
            'account_id' => $this->account_id,
            'category_id' => $this->category_id,
            'amount' => $this->amount,
            'date' => $this->date,
            'description' => $this->description,
        ]); $action->execute($dto); session()->flash('success', __('finance/transactions.created')); return to_route('admin.finance.transactions.index'); }
    protected function rules(): array { return Transaction::rules(); }
}