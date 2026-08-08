<?php

namespace App\Domain\HumanResources\Employee\Actions;

use App\Models\HumanResources\Employee;
use App\Models\AuditTrail;

class DeleteEmployeeAction
{
    public function execute(Employee $model): bool 
    {
        AuditTrail::log($model, 'delete', 'Employees');
        return $model->delete(); 
    }
}