<?php

namespace App\Domain\FleetManagement\Trip\Actions;

use App\Models\FleetManagement\Trip;
use App\Domain\FleetManagement\Trip\DTOs\TripDTO;
use App\Models\AuditTrail;

class CreateTripAction
{
    public function execute(TripDTO $dto): Trip 
    {
        $item = Trip::create($dto->toArray());
        AuditTrail::log($item, 'create', 'Trips');
        return $item;
    }
}