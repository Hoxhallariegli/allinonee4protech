<?php

namespace App\Domain\SchoolManagement\Student\Actions;

use App\Models\SchoolManagement\Student;
use App\Models\AuditTrail;

class DeleteStudentAction
{
    public function execute(Student $model): bool 
    {
        AuditTrail::log($model, 'delete', 'Students');
        return $model->delete(); 
    }
}