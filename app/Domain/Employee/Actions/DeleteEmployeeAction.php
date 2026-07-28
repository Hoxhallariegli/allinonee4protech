<?php

namespace App\Domain\Employee\Actions;

use App\Models\Employee;
use App\Models\AuditTrail;

class DeleteEmployeeAction
{
    public function execute(Employee $model): bool 
    {
        AuditTrail::log($model, 'delete', 'Employees');
        return $model->delete(); 
    }
}