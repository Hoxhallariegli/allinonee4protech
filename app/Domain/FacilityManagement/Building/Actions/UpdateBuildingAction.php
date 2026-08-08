<?php

namespace App\Domain\FacilityManagement\Building\Actions;

use App\Models\FacilityManagement\Building;
use App\Domain\FacilityManagement\Building\DTOs\BuildingDTO;
use App\Models\AuditTrail;

class UpdateBuildingAction
{
    public function execute(Building $model, BuildingDTO $dto): Building
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'Buildings');
        $model->save();
        return $model->fresh();
    }
}