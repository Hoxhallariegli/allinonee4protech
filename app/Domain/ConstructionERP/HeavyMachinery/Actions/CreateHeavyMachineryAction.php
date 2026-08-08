<?php

namespace App\Domain\ConstructionERP\HeavyMachinery\Actions;

use App\Models\ConstructionERP\HeavyMachinery;
use App\Domain\ConstructionERP\HeavyMachinery\DTOs\HeavyMachineryDTO;
use App\Models\AuditTrail;

class CreateHeavyMachineryAction
{
    public function execute(HeavyMachineryDTO $dto): HeavyMachinery 
    {
        $item = HeavyMachinery::create($dto->toArray());
        AuditTrail::log($item, 'create', 'HeavyMachineries');
        return $item;
    }
}