<?php

namespace App\Domain\AutoRepairManagement\ExpenseTracking\Actions;

use App\Models\AutoRepairManagement\ExpenseTracking;
use App\Models\AuditTrail;

class DeleteExpenseTrackingAction
{
    public function execute(ExpenseTracking $model): bool 
    {
        AuditTrail::log($model, 'delete', 'ExpenseTrackings');
        return $model->delete(); 
    }
}