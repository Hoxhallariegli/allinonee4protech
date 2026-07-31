<?php

namespace App\Domain\AutoRepairManagement\Estimate\Actions;

use App\Models\AutoRepairManagement\Estimate;
use App\Models\AuditTrail;

class DeleteEstimateAction
{
    public function execute(Estimate $model): bool 
    {
        AuditTrail::log($model, 'delete', 'Estimates');
        return $model->delete(); 
    }
}