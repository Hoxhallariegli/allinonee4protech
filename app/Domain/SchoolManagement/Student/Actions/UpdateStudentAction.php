<?php

namespace App\Domain\SchoolManagement\Student\Actions;

use App\Models\SchoolManagement\Student;
use App\Domain\SchoolManagement\Student\DTOs\StudentDTO;
use App\Models\AuditTrail;

class UpdateStudentAction
{
    public function execute(Student $model, StudentDTO $dto): Student
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'Students');
        $model->save();
        return $model->fresh();
    }
}