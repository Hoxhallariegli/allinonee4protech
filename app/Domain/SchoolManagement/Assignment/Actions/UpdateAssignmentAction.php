<?php

namespace App\Domain\SchoolManagement\Assignment\Actions;

use App\Models\SchoolManagement\Assignment;
use App\Domain\SchoolManagement\Assignment\DTOs\AssignmentDTO;
use App\Models\AuditTrail;

class UpdateAssignmentAction
{
    public function execute(Assignment $model, AssignmentDTO $dto): Assignment
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'Assignments');
        $model->save();
        return $model->fresh();
    }
}