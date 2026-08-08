<?php

namespace App\Domain\HumanResources\Department\Actions;

use App\Models\HumanResources\Department;
use App\Domain\HumanResources\Department\DTOs\DepartmentDTO;
use App\Models\AuditTrail;

class UpdateDepartmentAction
{
    public function execute(Department $model, DepartmentDTO $dto): Department
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'Departments');
        $model->save();
        return $model->fresh();
    }
}