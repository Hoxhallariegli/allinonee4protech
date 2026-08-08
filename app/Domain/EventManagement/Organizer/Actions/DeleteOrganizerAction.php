<?php

namespace App\Domain\EventManagement\Organizer\Actions;

use App\Models\EventManagement\Organizer;
use App\Models\AuditTrail;

class DeleteOrganizerAction
{
    public function execute(Organizer $model): bool 
    {
        AuditTrail::log($model, 'delete', 'Organizers');
        return $model->delete(); 
    }
}