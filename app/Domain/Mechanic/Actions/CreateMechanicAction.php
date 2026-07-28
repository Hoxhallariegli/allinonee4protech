<?php

namespace App\Domain\Mechanic\Actions;

use App\Models\Mechanic;
use App\Domain\Mechanic\DTOs\MechanicDTO;
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