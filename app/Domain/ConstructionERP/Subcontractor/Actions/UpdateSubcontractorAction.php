<?php

namespace App\Domain\ConstructionERP\Subcontractor\Actions;

use App\Models\ConstructionERP\Subcontractor;
use App\Domain\ConstructionERP\Subcontractor\DTOs\SubcontractorDTO;
use App\Models\AuditTrail;

class UpdateSubcontractorAction
{
    public function execute(Subcontractor $model, SubcontractorDTO $dto): Subcontractor
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'Subcontractors');
        $model->save();
        return $model->fresh();
    }
}