<?php

namespace App\Domain\FacilityManagement\MaintenanceRequest\Actions;

use App\Models\FacilityManagement\MaintenanceRequest;
use App\Models\AuditTrail;

class DeleteMaintenanceRequestAction
{
    public function execute(MaintenanceRequest $model): bool 
    {
        AuditTrail::log($model, 'delete', 'MaintenanceRequests');
        return $model->delete(); 
    }
}