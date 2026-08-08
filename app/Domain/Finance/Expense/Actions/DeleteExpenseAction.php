<?php

namespace App\Domain\Finance\Expense\Actions;

use App\Models\Finance\Expense;
use App\Models\AuditTrail;

class DeleteExpenseAction
{
    public function execute(Expense $model): bool 
    {
        AuditTrail::log($model, 'delete', 'Expenses');
        return $model->delete(); 
    }
}