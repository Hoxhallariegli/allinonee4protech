<?php

namespace App\Domain\SchoolManagement\Subject\Actions;

use App\Models\SchoolManagement\Subject;
use App\Domain\SchoolManagement\Subject\DTOs\SubjectDTO;
use App\Models\AuditTrail;

class UpdateSubjectAction
{
    public function execute(Subject $model, SubjectDTO $dto): Subject
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'Subjects');
        $model->save();
        return $model->fresh();
    }
}