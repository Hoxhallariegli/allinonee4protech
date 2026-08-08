<?php

namespace App\Domain\HumanResources\Employee\Actions;

use App\Models\HumanResources\Employee;
use App\Domain\HumanResources\Employee\DTOs\EmployeeDTO;
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