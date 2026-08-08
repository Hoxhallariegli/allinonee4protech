<?php

namespace App\Domain\TravelAgency\Destination\Actions;

use App\Models\TravelAgency\Destination;
use App\Domain\TravelAgency\Destination\DTOs\DestinationDTO;
use App\Models\AuditTrail;

class CreateDestinationAction
{
    public function execute(DestinationDTO $dto): Destination 
    {
        $item = Destination::create($dto->toArray());
        AuditTrail::log($item, 'create', 'Destinations');
        return $item;
    }
}