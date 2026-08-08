<?php

namespace App\Domain\TravelAgency\FlightTicket\Actions;

use App\Models\TravelAgency\FlightTicket;
use App\Domain\TravelAgency\FlightTicket\DTOs\FlightTicketDTO;
use App\Models\AuditTrail;

class CreateFlightTicketAction
{
    public function execute(FlightTicketDTO $dto): FlightTicket 
    {
        $item = FlightTicket::create($dto->toArray());
        AuditTrail::log($item, 'create', 'FlightTickets');
        return $item;
    }
}