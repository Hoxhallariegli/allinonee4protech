<?php

namespace App\Livewire\Admin\Finance\Transactions;

use App\Models\Finance\Transaction;
use App\Domain\Finance\Transaction\DTOs\TransactionDTO;
use App\Domain\Finance\Transaction\Actions\UpdateTransactionAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Edit Transaction')]
class Edit extends Component
{
        use WithPagination;
 public Transaction $item;
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

    public function mount(Transaction $transaction) { $this->item = $transaction; $this->fill($transaction->toArray()); $this->date = $transaction->date?->format('Y-m-d'); }
    public function render() {
        abort_if_cannot('edit_transactions');
        return view('livewire.admin.finance.transactions.edit', [
            'accounts' => $this->getaccountsList(),
            'categories' => $this->getcategoriesList(),
        ])->layout('components.layouts.app');
    }
    public function update(UpdateTransactionAction $action) { $this->validate();  $dto = TransactionDTO::fromArray([
            'account_id' => $this->account_id,
            'category_id' => $this->category_id,
            'amount' => $this->amount,
            'date' => $this->date,
            'description' => $this->description,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('finance/transactions.updated')); return to_route('admin.finance.transactions.index'); }
    protected function rules(): array { return Transaction::rules($this->item->id); }
}