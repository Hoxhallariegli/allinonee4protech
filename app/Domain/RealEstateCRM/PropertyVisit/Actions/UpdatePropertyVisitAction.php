<?php

namespace App\Domain\RealEstateCRM\PropertyVisit\Actions;

use App\Models\RealEstateCRM\PropertyVisit;
use App\Domain\RealEstateCRM\PropertyVisit\DTOs\PropertyVisitDTO;
use App\Models\AuditTrail;

class UpdatePropertyVisitAction
{
    public function execute(PropertyVisit $model, PropertyVisitDTO $dto): PropertyVisit
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'PropertyVisits');
        $model->save();
        return $model->fresh();
    }
}