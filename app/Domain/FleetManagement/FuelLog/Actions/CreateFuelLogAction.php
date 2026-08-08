<?php

namespace App\Domain\FleetManagement\FuelLog\Actions;

use App\Models\FleetManagement\FuelLog;
use App\Domain\FleetManagement\FuelLog\DTOs\FuelLogDTO;
use App\Models\AuditTrail;

class CreateFuelLogAction
{
    public function execute(FuelLogDTO $dto): FuelLog 
    {
        $item = FuelLog::create($dto->toArray());
        AuditTrail::log($item, 'create', 'FuelLogs');
        return $item;
    }
}