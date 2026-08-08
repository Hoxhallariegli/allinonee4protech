<?php

namespace App\Domain\HumanResources\Attendance\Actions;

use App\Models\HumanResources\Attendance;
use App\Models\AuditTrail;

class DeleteAttendanceAction
{
    public function execute(Attendance $model): bool 
    {
        AuditTrail::log($model, 'delete', 'Attendances');
        return $model->delete(); 
    }
}