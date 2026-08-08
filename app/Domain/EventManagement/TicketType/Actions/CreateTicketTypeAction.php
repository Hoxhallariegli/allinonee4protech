<?php

namespace App\Domain\EventManagement\TicketType\Actions;

use App\Models\EventManagement\TicketType;
use App\Domain\EventManagement\TicketType\DTOs\TicketTypeDTO;
use App\Models\AuditTrail;

class CreateTicketTypeAction
{
    public function execute(TicketTypeDTO $dto): TicketType 
    {
        $item = TicketType::create($dto->toArray());
        AuditTrail::log($item, 'create', 'TicketTypes');
        return $item;
    }
}