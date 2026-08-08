<?php

namespace App\Domain\SchoolManagement\Assignment\Actions;

use App\Models\SchoolManagement\Assignment;
use App\Models\AuditTrail;

class DeleteAssignmentAction
{
    public function execute(Assignment $model): bool 
    {
        AuditTrail::log($model, 'delete', 'Assignments');
        return $model->delete(); 
    }
}