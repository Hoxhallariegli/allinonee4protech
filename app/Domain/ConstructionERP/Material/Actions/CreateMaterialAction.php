<?php

namespace App\Domain\ConstructionERP\Material\Actions;

use App\Models\ConstructionERP\Material;
use App\Domain\ConstructionERP\Material\DTOs\MaterialDTO;
use App\Models\AuditTrail;

class CreateMaterialAction
{
    public function execute(MaterialDTO $dto): Material 
    {
        $item = Material::create($dto->toArray());
        AuditTrail::log($item, 'create', 'Materials');
        return $item;
    }
}