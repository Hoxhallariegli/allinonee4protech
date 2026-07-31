<?php

namespace App\Domain\SchoolManagement\Exam\Actions;

use App\Models\SchoolManagement\Exam;
use App\Domain\SchoolManagement\Exam\DTOs\ExamDTO;
use App\Models\AuditTrail;

class UpdateExamAction
{
    public function execute(Exam $model, ExamDTO $dto): Exam
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'Exams');
        $model->save();
        return $model->fresh();
    }
}