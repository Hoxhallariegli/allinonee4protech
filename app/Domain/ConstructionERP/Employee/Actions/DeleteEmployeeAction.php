<?php

namespace App\Domain\ConstructionERP\Employee\Actions;

use App\Models\ConstructionERP\Employee;
use App\Models\AuditTrail;

class DeleteEmployeeAction
{
    public function execute(Employee $model): bool 
    {
        AuditTrail::log($model, 'delete', 'Employees');
        return $model->delete(); 
    }
}