<?php

namespace App\Domain\SchoolManagement\SchoolClass\Actions;

use App\Models\SchoolManagement\SchoolClass;
use App\Models\AuditTrail;

class DeleteSchoolClassAction
{
    public function execute(SchoolClass $model): bool 
    {
        AuditTrail::log($model, 'delete', 'SchoolClasses');
        return $model->delete(); 
    }
}