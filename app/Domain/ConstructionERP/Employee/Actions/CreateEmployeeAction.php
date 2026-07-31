<?php

namespace App\Domain\ConstructionERP\Employee\Actions;

use App\Models\ConstructionERP\Employee;
use App\Domain\ConstructionERP\Employee\DTOs\EmployeeDTO;
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