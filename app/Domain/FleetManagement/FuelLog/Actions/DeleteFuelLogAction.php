<?php

namespace App\Domain\FleetManagement\FuelLog\Actions;

use App\Models\FleetManagement\FuelLog;
use App\Models\AuditTrail;

class DeleteFuelLogAction
{
    public function execute(FuelLog $model): bool 
    {
        AuditTrail::log($model, 'delete', 'FuelLogs');
        return $model->delete(); 
    }
}