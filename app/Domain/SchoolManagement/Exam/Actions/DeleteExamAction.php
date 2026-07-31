<?php

namespace App\Domain\SchoolManagement\Exam\Actions;

use App\Models\SchoolManagement\Exam;
use App\Models\AuditTrail;

class DeleteExamAction
{
    public function execute(Exam $model): bool 
    {
        AuditTrail::log($model, 'delete', 'Exams');
        return $model->delete(); 
    }
}