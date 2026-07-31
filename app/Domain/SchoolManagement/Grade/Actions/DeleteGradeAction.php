<?php

namespace App\Domain\SchoolManagement\Grade\Actions;

use App\Models\SchoolManagement\Grade;
use App\Models\AuditTrail;

class DeleteGradeAction
{
    public function execute(Grade $model): bool 
    {
        AuditTrail::log($model, 'delete', 'Grades');
        return $model->delete(); 
    }
}