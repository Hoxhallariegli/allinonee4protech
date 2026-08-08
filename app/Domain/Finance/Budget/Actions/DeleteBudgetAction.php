<?php

namespace App\Domain\Finance\Budget\Actions;

use App\Models\Finance\Budget;
use App\Models\AuditTrail;

class DeleteBudgetAction
{
    public function execute(Budget $model): bool 
    {
        AuditTrail::log($model, 'delete', 'Budgets');
        return $model->delete(); 
    }
}