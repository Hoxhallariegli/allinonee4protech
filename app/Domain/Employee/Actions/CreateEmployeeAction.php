<?php

namespace App\Domain\Employee\Actions;

use App\Models\Employee;
use App\Domain\Employee\DTOs\EmployeeDTO;
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