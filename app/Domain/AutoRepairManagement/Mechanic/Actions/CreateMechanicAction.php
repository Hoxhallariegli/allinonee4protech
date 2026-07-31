<?php

namespace App\Domain\AutoRepairManagement\Mechanic\Actions;

use App\Models\AutoRepairManagement\Mechanic;
use App\Domain\AutoRepairManagement\Mechanic\DTOs\MechanicDTO;
use App\Models\AuditTrail;

class CreateMechanicAction
{
    public function execute(MechanicDTO $dto): Mechanic 
    {
        $item = Mechanic::create($dto->toArray());
        AuditTrail::log($item, 'create', 'Mechanics');
        return $item;
    }
}