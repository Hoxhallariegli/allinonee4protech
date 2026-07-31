<?php

namespace App\Domain\ConstructionERP\Building\Actions;

use App\Models\ConstructionERP\Building;
use App\Domain\ConstructionERP\Building\DTOs\BuildingDTO;
use App\Models\AuditTrail;

class CreateBuildingAction
{
    public function execute(BuildingDTO $dto): Building 
    {
        $item = Building::create($dto->toArray());
        AuditTrail::log($item, 'create', 'Buildings');
        return $item;
    }
}