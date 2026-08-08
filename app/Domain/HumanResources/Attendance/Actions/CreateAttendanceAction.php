<?php

namespace App\Domain\HumanResources\Attendance\Actions;

use App\Models\HumanResources\Attendance;
use App\Domain\HumanResources\Attendance\DTOs\AttendanceDTO;
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