<?php

namespace App\Domain\AutoRepairManagement\EstimateItem\Actions;

use App\Models\AutoRepairManagement\EstimateItem;
use App\Models\AuditTrail;

class DeleteEstimateItemAction
{
    public function execute(EstimateItem $model): bool 
    {
        AuditTrail::log($model, 'delete', 'EstimateItems');
        return $model->delete(); 
    }
}