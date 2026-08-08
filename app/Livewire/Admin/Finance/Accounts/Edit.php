<?php

namespace App\Livewire\Admin\Finance\Accounts;

use App\Models\Finance\Account;
use App\Domain\Finance\Account\DTOs\AccountDTO;
use App\Domain\Finance\Account\Actions\UpdateAccountAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Edit Account')]
class Edit extends Component
{
        use WithPagination;
 public Account $item;
    public $name = '';
    public $type = '';
    public $balance = '';
   
    public function mount(Account $account) { $this->item = $account; $this->fill($account->toArray());  }
    public function render() {
        abort_if_cannot('edit_accounts');
        return view('livewire.admin.finance.accounts.edit', [
        ])->layout('components.layouts.app');
    }
    public function update(UpdateAccountAction $action) { $this->validate();  $dto = AccountDTO::fromArray([
            'name' => $this->name,
            'type' => $this->type,
            'balance' => $this->balance,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('finance/accounts.updated')); return to_route('admin.finance.accounts.index'); }
    protected function rules(): array { return Account::rules($this->item->id); }
}