<?php

namespace App\Domain\SchoolManagement\Attendance\Actions;

use App\Models\SchoolManagement\Attendance;
use App\Models\AuditTrail;

class DeleteAttendanceAction
{
    public function execute(Attendance $model): bool 
    {
        AuditTrail::log($model, 'delete', 'Attendances');
        return $model->delete(); 
    }
}