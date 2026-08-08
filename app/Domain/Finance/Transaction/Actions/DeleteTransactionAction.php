<?php

namespace App\Domain\Finance\Transaction\Actions;

use App\Models\Finance\Transaction;
use App\Models\AuditTrail;

class DeleteTransactionAction
{
    public function execute(Transaction $model): bool 
    {
        AuditTrail::log($model, 'delete', 'Transactions');
        return $model->delete(); 
    }
}