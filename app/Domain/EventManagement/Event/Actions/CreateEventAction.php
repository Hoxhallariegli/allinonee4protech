<?php

namespace App\Domain\EventManagement\Event\Actions;

use App\Models\EventManagement\Event;
use App\Domain\EventManagement\Event\DTOs\EventDTO;
use App\Models\AuditTrail;

class CreateEventAction
{
    public function execute(EventDTO $dto): Event 
    {
        $item = Event::create($dto->toArray());
        AuditTrail::log($item, 'create', 'Events');
        return $item;
    }
}