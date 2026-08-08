<?php

namespace App\Domain\Finance\Account\Actions;

use App\Models\Finance\Account;
use App\Models\AuditTrail;

class DeleteAccountAction
{
    public function execute(Account $model): bool 
    {
        AuditTrail::log($model, 'delete', 'Accounts');
        return $model->delete(); 
    }
}