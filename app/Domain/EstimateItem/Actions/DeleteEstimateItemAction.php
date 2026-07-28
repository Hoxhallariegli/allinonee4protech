<?php

namespace App\Domain\EstimateItem\Actions;

use App\Models\EstimateItem;
use App\Models\AuditTrail;

class DeleteEstimateItemAction
{
    public function execute(EstimateItem $model): bool 
    {
        AuditTrail::log($model, 'delete', 'EstimateItems');
        return $model->delete(); 
    }
}