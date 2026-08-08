<?php

namespace App\Domain\WarehouseManagement\Employee\Actions;

use App\Models\WarehouseManagement\Employee;
use App\Domain\WarehouseManagement\Employee\DTOs\EmployeeDTO;
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