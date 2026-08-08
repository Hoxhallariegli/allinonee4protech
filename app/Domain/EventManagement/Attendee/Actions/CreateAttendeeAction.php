<?php

namespace App\Domain\EventManagement\Attendee\Actions;

use App\Models\EventManagement\Attendee;
use App\Domain\EventManagement\Attendee\DTOs\AttendeeDTO;
use App\Models\AuditTrail;

class CreateAttendeeAction
{
    public function execute(AttendeeDTO $dto): Attendee 
    {
        $item = Attendee::create($dto->toArray());
        AuditTrail::log($item, 'create', 'Attendees');
        return $item;
    }
}