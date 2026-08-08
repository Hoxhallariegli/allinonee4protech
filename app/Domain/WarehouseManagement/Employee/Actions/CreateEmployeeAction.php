<?php

namespace App\Domain\WarehouseManagement\Employee\Actions;

use App\Models\WarehouseManagement\Employee;
use App\Domain\WarehouseManagement\Employee\DTOs\EmployeeDTO;
use App\Models\AuditTrail;

class CreateEmployeeAction
{
    public function execute(EmployeeDTO $dto): Employee 
    {
        $item = Employee::create($dto->toArray());
        AuditTrail::log($item, 'create', 'Employees');
        return $item;
    }
}