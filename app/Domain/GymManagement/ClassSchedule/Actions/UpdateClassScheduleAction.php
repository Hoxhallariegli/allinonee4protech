<?php

namespace App\Domain\GymManagement\ClassSchedule\Actions;

use App\Models\GymManagement\ClassSchedule;
use App\Domain\GymManagement\ClassSchedule\DTOs\ClassScheduleDTO;
use App\Models\AuditTrail;

class UpdateClassScheduleAction
{
    public function execute(ClassSchedule $model, ClassScheduleDTO $dto): ClassSchedule
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'ClassSchedules');
        $model->save();
        return $model->fresh();
    }
}