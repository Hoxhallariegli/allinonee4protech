<?php

namespace App\Domain\SchoolManagement\Subject\Actions;

use App\Models\SchoolManagement\Subject;
use App\Models\AuditTrail;

class DeleteSubjectAction
{
    public function execute(Subject $model): bool 
    {
        AuditTrail::log($model, 'delete', 'Subjects');
        return $model->delete(); 
    }
}