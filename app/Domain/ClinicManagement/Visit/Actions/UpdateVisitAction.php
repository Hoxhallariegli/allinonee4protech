<?php

namespace App\Domain\ClinicManagement\Visit\Actions;

use App\Models\ClinicManagement\Visit;
use App\Domain\ClinicManagement\Visit\DTOs\VisitDTO;
use App\Models\AuditTrail;

class UpdateVisitAction
{
    public function execute(Visit $model, VisitDTO $dto): Visit
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'Visits');
        $model->save();
        return $model->fresh();
    }
}