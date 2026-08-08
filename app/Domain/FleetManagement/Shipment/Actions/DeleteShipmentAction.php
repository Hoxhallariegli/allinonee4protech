<?php

namespace App\Domain\FleetManagement\Shipment\Actions;

use App\Models\FleetManagement\Shipment;
use App\Models\AuditTrail;

class DeleteShipmentAction
{
    public function execute(Shipment $model): bool 
    {
        AuditTrail::log($model, 'delete', 'Shipments');
        return $model->delete(); 
    }
}