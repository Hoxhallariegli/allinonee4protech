<?php

namespace App\Domain\SchoolManagement\Teacher\Actions;

use App\Models\SchoolManagement\Teacher;
use App\Models\AuditTrail;

class DeleteTeacherAction
{
    public function execute(Teacher $model): bool 
    {
        AuditTrail::log($model, 'delete', 'Teachers');
        return $model->delete(); 
    }
}