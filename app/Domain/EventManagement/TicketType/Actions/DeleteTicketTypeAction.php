<?php

namespace App\Domain\EventManagement\TicketType\Actions;

use App\Models\EventManagement\TicketType;
use App\Models\AuditTrail;

class DeleteTicketTypeAction
{
    public function execute(TicketType $model): bool 
    {
        AuditTrail::log($model, 'delete', 'TicketTypes');
        return $model->delete(); 
    }
}