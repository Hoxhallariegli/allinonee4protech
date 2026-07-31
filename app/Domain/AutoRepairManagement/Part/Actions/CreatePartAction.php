<?php

namespace App\Domain\AutoRepairManagement\Part\Actions;

use App\Models\AutoRepairManagement\Part;
use App\Domain\AutoRepairManagement\Part\DTOs\PartDTO;
use App\Models\AuditTrail;

class CreatePartAction
{
    public function execute(PartDTO $dto): Part 
    {
        $item = Part::create($dto->toArray());
        AuditTrail::log($item, 'create', 'Parts');
        return $item;
    }
}