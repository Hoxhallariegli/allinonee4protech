<?php

namespace App\Domain\ConstructionERP\Subcontractor\Actions;

use App\Models\ConstructionERP\Subcontractor;
use App\Domain\ConstructionERP\Subcontractor\DTOs\SubcontractorDTO;
use App\Models\AuditTrail;

class CreateSubcontractorAction
{
    public function execute(SubcontractorDTO $dto): Subcontractor 
    {
        $item = Subcontractor::create($dto->toArray());
        AuditTrail::log($item, 'create', 'Subcontractors');
        return $item;
    }
}