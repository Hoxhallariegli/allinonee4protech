<?php

namespace App\Domain\SchoolManagement\Grade\Actions;

use App\Models\SchoolManagement\Grade;
use App\Domain\SchoolManagement\Grade\DTOs\GradeDTO;
use App\Models\AuditTrail;

class UpdateGradeAction
{
    public function execute(Grade $model, GradeDTO $dto): Grade
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'Grades');
        $model->save();
        return $model->fresh();
    }
}