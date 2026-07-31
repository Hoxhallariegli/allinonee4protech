<?php

namespace App\Domain\AutoRepairManagement\Employee\Actions;

use App\Models\AutoRepairManagement\Employee;
use App\Domain\AutoRepairManagement\Employee\DTOs\EmployeeDTO;
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