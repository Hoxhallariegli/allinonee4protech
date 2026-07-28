<?php

namespace App\Domain\Estimate\Actions;

use App\Models\Estimate;
use App\Domain\Estimate\DTOs\EstimateDTO;
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