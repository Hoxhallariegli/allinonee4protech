<?php

namespace App\Domain\SchoolManagement\Timetable\Actions;

use App\Models\SchoolManagement\Timetable;
use App\Domain\SchoolManagement\Timetable\DTOs\TimetableDTO;
use App\Models\AuditTrail;

class CreateTimetableAction
{
    public function execute(TimetableDTO $dto): Timetable 
    {
        $item = Timetable::create($dto->toArray());
        AuditTrail::log($item, 'create', 'Timetables');
        return $item;
    }
}