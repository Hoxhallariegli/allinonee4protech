<?php

namespace App\Domain\HumanResources\Employee\Actions;

use App\Models\HumanResources\Employee;
use App\Domain\HumanResources\Employee\DTOs\EmployeeDTO;
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