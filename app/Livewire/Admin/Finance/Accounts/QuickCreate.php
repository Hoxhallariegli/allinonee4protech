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

class QuickCreate extends Component
{
        use WithPagination;
     public $name = '';
    public $type = '';
    public $balance = '';
   
    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.finance.accounts.quick-create', [
        ]); }

    public function store(CreateAccountAction $action)
    {
        $this->validate();
        $dto = AccountDTO::fromArray([
            'name' => $this->name,
            'type' => $this->type,
            'balance' => $this->balance,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('account-created', id: $item->id);
        $this->js("Livewire.dispatch('account-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('finance/accounts.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->name ?? $item->id);
        $this->reset(['name', 'type', 'balance']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return Account::rules(); }
}