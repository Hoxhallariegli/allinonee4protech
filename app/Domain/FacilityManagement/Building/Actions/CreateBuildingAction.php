<?php

namespace App\Domain\FacilityManagement\Building\Actions;

use App\Models\FacilityManagement\Building;
use App\Domain\FacilityManagement\Building\DTOs\BuildingDTO;
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