<?php

namespace App\Domain\SchoolManagement\Teacher\Actions;

use App\Models\SchoolManagement\Teacher;
use App\Domain\SchoolManagement\Teacher\DTOs\TeacherDTO;
use App\Models\AuditTrail;

class UpdateTeacherAction
{
    public function execute(Teacher $model, TeacherDTO $dto): Teacher
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'Teachers');
        $model->save();
        return $model->fresh();
    }
}