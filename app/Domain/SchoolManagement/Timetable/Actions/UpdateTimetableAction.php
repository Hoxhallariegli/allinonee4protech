<?php

namespace App\Domain\SchoolManagement\Timetable\Actions;

use App\Models\SchoolManagement\Timetable;
use App\Domain\SchoolManagement\Timetable\DTOs\TimetableDTO;
use App\Models\AuditTrail;

class UpdateTimetableAction
{
    public function execute(Timetable $model, TimetableDTO $dto): Timetable
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'Timetables');
        $model->save();
        return $model->fresh();
    }
}