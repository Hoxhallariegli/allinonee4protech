<?php

namespace App\Domain\AutoRepairManagement\Employee\Actions;

use App\Models\AutoRepairManagement\Employee;
use App\Models\AuditTrail;

class DeleteEmployeeAction
{
    public function execute(Employee $model): bool 
    {
        AuditTrail::log($model, 'delete', 'Employees');
        return $model->delete(); 
    }
}