<?php

namespace App\Domain\HumanResources\Payroll\Actions;

use App\Models\HumanResources\Payroll;
use App\Models\AuditTrail;

class DeletePayrollAction
{
    public function execute(Payroll $model): bool 
    {
        AuditTrail::log($model, 'delete', 'Payrolls');
        return $model->delete(); 
    }
}