<?php

namespace App\Domain\HumanResources\Department\Actions;

use App\Models\HumanResources\Department;
use App\Models\AuditTrail;

class DeleteDepartmentAction
{
    public function execute(Department $model): bool 
    {
        AuditTrail::log($model, 'delete', 'Departments');
        return $model->delete(); 
    }
}