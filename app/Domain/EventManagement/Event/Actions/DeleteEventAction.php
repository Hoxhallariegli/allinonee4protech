<?php

namespace App\Domain\EventManagement\Event\Actions;

use App\Models\EventManagement\Event;
use App\Models\AuditTrail;

class DeleteEventAction
{
    public function execute(Event $model): bool 
    {
        AuditTrail::log($model, 'delete', 'Events');
        return $model->delete(); 
    }
}