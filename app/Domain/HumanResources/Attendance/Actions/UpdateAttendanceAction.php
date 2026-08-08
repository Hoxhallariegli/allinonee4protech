<?php

namespace App\Domain\HumanResources\Attendance\Actions;

use App\Models\HumanResources\Attendance;
use App\Domain\HumanResources\Attendance\DTOs\AttendanceDTO;
use App\Models\AuditTrail;

class UpdateAttendanceAction
{
    public function execute(Attendance $model, AttendanceDTO $dto): Attendance
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'Attendances');
        $model->save();
        return $model->fresh();
    }
}