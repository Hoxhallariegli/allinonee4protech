<?php

namespace App\Domain\Finance\Account\Actions;

use App\Models\Finance\Account;
use App\Domain\Finance\Account\DTOs\AccountDTO;
use App\Models\AuditTrail;

class UpdateAccountAction
{
    public function execute(Account $model, AccountDTO $dto): Account
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'Accounts');
        $model->save();
        return $model->fresh();
    }
}