<?php

namespace App\Domain\GymManagement\ClassSchedule\Actions;

use App\Models\GymManagement\ClassSchedule;
use App\Domain\GymManagement\ClassSchedule\DTOs\ClassScheduleDTO;
use App\Models\AuditTrail;

class CreateClassScheduleAction
{
    public function execute(ClassScheduleDTO $dto): ClassSchedule 
    {
        $item = ClassSchedule::create($dto->toArray());
        AuditTrail::log($item, 'create', 'ClassSchedules');
        return $item;
    }
}