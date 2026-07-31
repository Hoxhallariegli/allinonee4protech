<?php

namespace App\Domain\AutoRepairManagement\VehicleDocument\Actions;

use App\Models\AutoRepairManagement\VehicleDocument;
use App\Models\AuditTrail;

class DeleteVehicleDocumentAction
{
    public function execute(VehicleDocument $model): bool 
    {
        AuditTrail::log($model, 'delete', 'VehicleDocuments');
        return $model->delete(); 
    }
}