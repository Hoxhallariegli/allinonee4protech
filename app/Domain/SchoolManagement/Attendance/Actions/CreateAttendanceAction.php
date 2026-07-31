<?php

namespace App\Domain\SchoolManagement\Attendance\Actions;

use App\Models\SchoolManagement\Attendance;
use App\Domain\SchoolManagement\Attendance\DTOs\AttendanceDTO;
use App\Models\AuditTrail;

class CreateAttendanceAction
{
    public function execute(AttendanceDTO $dto): Attendance 
    {
        $item = Attendance::create($dto->toArray());
        AuditTrail::log($item, 'create', 'Attendances');
        return $item;
    }
}