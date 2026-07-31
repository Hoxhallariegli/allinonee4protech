<?php

namespace App\Domain\AutoRepairManagement\Estimate\Actions;

use App\Models\AutoRepairManagement\Estimate;
use App\Domain\AutoRepairManagement\Estimate\DTOs\EstimateDTO;
use App\Models\AuditTrail;

class UpdateEstimateAction
{
    public function execute(Estimate $model, EstimateDTO $dto): Estimate
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'Estimates');
        $model->save();
        return $model->fresh();
    }
}