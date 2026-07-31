<?php

namespace App\Domain\ConstructionERP\Material\Actions;

use App\Models\ConstructionERP\Material;
use App\Domain\ConstructionERP\Material\DTOs\MaterialDTO;
use App\Models\AuditTrail;

class UpdateMaterialAction
{
    public function execute(Material $model, MaterialDTO $dto): Material
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'Materials');
        $model->save();
        return $model->fresh();
    }
}