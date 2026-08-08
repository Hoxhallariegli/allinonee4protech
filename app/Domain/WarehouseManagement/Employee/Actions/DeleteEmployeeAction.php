<?php

namespace App\Domain\WarehouseManagement\Employee\Actions;

use App\Models\WarehouseManagement\Employee;
use App\Models\AuditTrail;

class DeleteEmployeeAction
{
    public function execute(Employee $model): bool 
    {
        AuditTrail::log($model, 'delete', 'Employees');
        return $model->delete(); 
    }
}