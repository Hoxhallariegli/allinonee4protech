<?php

namespace App\Domain\EventManagement\Organizer\Actions;

use App\Models\EventManagement\Organizer;
use App\Domain\EventManagement\Organizer\DTOs\OrganizerDTO;
use App\Models\AuditTrail;

class CreateOrganizerAction
{
    public function execute(OrganizerDTO $dto): Organizer 
    {
        $item = Organizer::create($dto->toArray());
        AuditTrail::log($item, 'create', 'Organizers');
        return $item;
    }
}