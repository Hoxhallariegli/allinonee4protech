<?php

namespace App\Domain\GymManagement\ClassSchedule\Actions;

use App\Models\GymManagement\ClassSchedule;
use App\Models\AuditTrail;

class DeleteClassScheduleAction
{
    public function execute(ClassSchedule $model): bool 
    {
        AuditTrail::log($model, 'delete', 'ClassSchedules');
        return $model->delete(); 
    }
}