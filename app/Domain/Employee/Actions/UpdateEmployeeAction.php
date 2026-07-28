<?php

namespace App\Domain\Employee\Actions;

use App\Models\Employee;
use App\Domain\Employee\DTOs\EmployeeDTO;
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