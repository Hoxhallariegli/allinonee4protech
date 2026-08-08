<?php

namespace App\Domain\EventManagement\Attendee\Actions;

use App\Models\EventManagement\Attendee;
use App\Models\AuditTrail;

class DeleteAttendeeAction
{
    public function execute(Attendee $model): bool 
    {
        AuditTrail::log($model, 'delete', 'Attendees');
        return $model->delete(); 
    }
}