<?php

namespace App\Domain\VehicleDocument\Actions;

use App\Models\VehicleDocument;
use App\Models\AuditTrail;

class DeleteVehicleDocumentAction
{
    public function execute(VehicleDocument $model): bool 
    {
        AuditTrail::log($model, 'delete', 'VehicleDocuments');
        return $model->delete(); 
    }
}