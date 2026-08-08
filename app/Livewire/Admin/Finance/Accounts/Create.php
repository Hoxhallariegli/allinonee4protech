<?php

namespace App\Livewire\Admin\Finance\Accounts;

use App\Models\Finance\Account;
use App\Domain\Finance\Account\DTOs\AccountDTO;
use App\Domain\Finance\Account\Actions\CreateAccountAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Add Account')]
class Create extends Component
{
        use WithPagination;
     public $name = '';
    public $type = '';
    public $balance = '';
   
    public function render() {
        abort_if_cannot('add_accounts');
        return view('livewire.admin.finance.accounts.create', [
        ])->layout('components.layouts.app');
    }
    public function store(CreateAccountAction $action) { $this->validate();  $dto = AccountDTO::fromArray([
            'name' => $this->name,
            'type' => $this->type,
            'balance' => $this->balance,
        ]); $action->execute($dto); session()->flash('success', __('finance/accounts.created')); return to_route('admin.finance.accounts.index'); }
    protected function rules(): array { return Account::rules(); }
}