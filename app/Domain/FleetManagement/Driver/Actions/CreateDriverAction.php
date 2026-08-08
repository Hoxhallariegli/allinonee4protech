<?php

namespace App\Domain\FleetManagement\Driver\Actions;

use App\Models\FleetManagement\Driver;
use App\Domain\FleetManagement\Driver\DTOs\DriverDTO;
use App\Models\AuditTrail;

class CreateDriverAction
{
    public function execute(DriverDTO $dto): Driver 
    {
        $item = Driver::create($dto->toArray());
        AuditTrail::log($item, 'create', 'Drivers');
        return $item;
    }
}