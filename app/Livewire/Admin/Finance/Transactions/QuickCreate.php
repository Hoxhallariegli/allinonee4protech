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

class QuickCreate extends Component
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

    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.finance.transactions.quick-create', [
            'accounts' => $this->getaccountsList(),
            'categories' => $this->getcategoriesList(),
        ]); }

    public function store(CreateTransactionAction $action)
    {
        $this->validate();
        $dto = TransactionDTO::fromArray([
            'account_id' => $this->account_id,
            'category_id' => $this->category_id,
            'amount' => $this->amount,
            'date' => $this->date,
            'description' => $this->description,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('transaction-created', id: $item->id);
        $this->js("Livewire.dispatch('transaction-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('finance/transactions.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->id ?? $item->id);
        $this->reset(['account_id', 'category_id', 'amount', 'date', 'description']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return Transaction::rules(); }
}