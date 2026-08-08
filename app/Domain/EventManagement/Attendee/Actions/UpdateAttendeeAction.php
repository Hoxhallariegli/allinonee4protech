<?php

namespace App\Domain\EventManagement\Attendee\Actions;

use App\Models\EventManagement\Attendee;
use App\Domain\EventManagement\Attendee\DTOs\AttendeeDTO;
use App\Models\AuditTrail;

class UpdateAttendeeAction
{
    public function execute(Attendee $model, AttendeeDTO $dto): Attendee
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'Attendees');
        $model->save();
        return $model->fresh();
    }
}