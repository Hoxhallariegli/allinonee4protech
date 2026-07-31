<?php

namespace App\Domain\AutoRepairManagement\Employee\Actions;

use App\Models\AutoRepairManagement\Employee;
use App\Domain\AutoRepairManagement\Employee\DTOs\EmployeeDTO;
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