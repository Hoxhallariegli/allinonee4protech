<?php

namespace App\Domain\SchoolManagement\Exam\Actions;

use App\Models\SchoolManagement\Exam;
use App\Domain\SchoolManagement\Exam\DTOs\ExamDTO;
use App\Models\AuditTrail;

class CreateExamAction
{
    public function execute(ExamDTO $dto): Exam 
    {
        $item = Exam::create($dto->toArray());
        AuditTrail::log($item, 'create', 'Exams');
        return $item;
    }
}