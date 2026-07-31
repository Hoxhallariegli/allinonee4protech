<?php

namespace App\Domain\SchoolManagement\Attendance\Actions;

use App\Models\SchoolManagement\Attendance;
use App\Domain\SchoolManagement\Attendance\DTOs\AttendanceDTO;
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