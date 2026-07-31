<?php

namespace App\Domain\AutoRepairManagement\EstimateItem\Actions;

use App\Models\AutoRepairManagement\EstimateItem;
use App\Domain\AutoRepairManagement\EstimateItem\DTOs\EstimateItemDTO;
use App\Models\AuditTrail;

class UpdateEstimateItemAction
{
    public function execute(EstimateItem $model, EstimateItemDTO $dto): EstimateItem
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'EstimateItems');
        $model->save();
        return $model->fresh();
    }
}