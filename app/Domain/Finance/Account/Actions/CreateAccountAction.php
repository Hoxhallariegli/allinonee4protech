<?php

namespace App\Domain\Finance\Account\Actions;

use App\Models\Finance\Account;
use App\Domain\Finance\Account\DTOs\AccountDTO;
use App\Models\AuditTrail;

class CreateAccountAction
{
    public function execute(AccountDTO $dto): Account 
    {
        $item = Account::create($dto->toArray());
        AuditTrail::log($item, 'create', 'Accounts');
        return $item;
    }
}