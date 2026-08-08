<?php

namespace App\Domain\TravelAgency\FlightTicket\Actions;

use App\Models\TravelAgency\FlightTicket;
use App\Domain\TravelAgency\FlightTicket\DTOs\FlightTicketDTO;
use App\Models\AuditTrail;

class UpdateFlightTicketAction
{
    public function execute(FlightTicket $model, FlightTicketDTO $dto): FlightTicket
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'FlightTickets');
        $model->save();
        return $model->fresh();
    }
}