<?php

namespace App\Domain\HumanResources\Department\Actions;

use App\Models\HumanResources\Department;
use App\Domain\HumanResources\Department\DTOs\DepartmentDTO;
use App\Models\AuditTrail;

class CreateDepartmentAction
{
    public function execute(DepartmentDTO $dto): Department 
    {
        $item = Department::create($dto->toArray());
        AuditTrail::log($item, 'create', 'Departments');
        return $item;
    }
}