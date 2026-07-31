<?php

namespace App\Domain\ConstructionERP\Employee\Actions;

use App\Models\ConstructionERP\Employee;
use App\Domain\ConstructionERP\Employee\DTOs\EmployeeDTO;
use App\Models\AuditTrail;

class UpdateEmployeeAction
{
    public function execute(Employee $model, EmployeeDTO $dto): Employee
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'Employees');
        $model->save();
        return $model->fresh();
    }
}