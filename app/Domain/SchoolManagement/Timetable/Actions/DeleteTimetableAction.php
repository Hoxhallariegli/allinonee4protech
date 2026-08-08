<?php

namespace App\Domain\SchoolManagement\Timetable\Actions;

use App\Models\SchoolManagement\Timetable;
use App\Models\AuditTrail;

class DeleteTimetableAction
{
    public function execute(Timetable $model): bool 
    {
        AuditTrail::log($model, 'delete', 'Timetables');
        return $model->delete(); 
    }
}