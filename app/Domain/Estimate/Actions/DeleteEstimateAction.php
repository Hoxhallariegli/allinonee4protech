<?php

namespace App\Domain\Estimate\Actions;

use App\Models\Estimate;
use App\Models\AuditTrail;

class DeleteEstimateAction
{
    public function execute(Estimate $model): bool 
    {
        AuditTrail::log($model, 'delete', 'Estimates');
        return $model->delete(); 
    }
}