<?php

namespace App\Domain\TravelAgency\FlightTicket\Actions;

use App\Models\TravelAgency\FlightTicket;
use App\Models\AuditTrail;

class DeleteFlightTicketAction
{
    public function execute(FlightTicket $model): bool 
    {
        AuditTrail::log($model, 'delete', 'FlightTickets');
        return $model->delete(); 
    }
}