<?php

namespace App\Domain\FleetManagement\Driver\Actions;

use App\Models\FleetManagement\Driver;
use App\Models\AuditTrail;

class DeleteDriverAction
{
    public function execute(Driver $model): bool 
    {
        AuditTrail::log($model, 'delete', 'Drivers');
        return $model->delete(); 
    }
}