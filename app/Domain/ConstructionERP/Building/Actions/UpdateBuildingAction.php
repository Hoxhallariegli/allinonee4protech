<?php

namespace App\Domain\ConstructionERP\Building\Actions;

use App\Models\ConstructionERP\Building;
use App\Domain\ConstructionERP\Building\DTOs\BuildingDTO;
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