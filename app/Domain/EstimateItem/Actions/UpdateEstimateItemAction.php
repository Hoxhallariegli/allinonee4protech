<?php

namespace App\Domain\EstimateItem\Actions;

use App\Models\EstimateItem;
use App\Domain\EstimateItem\DTOs\EstimateItemDTO;
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