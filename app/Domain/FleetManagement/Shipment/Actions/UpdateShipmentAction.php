<?php

namespace App\Domain\FleetManagement\Shipment\Actions;

use App\Models\FleetManagement\Shipment;
use App\Domain\FleetManagement\Shipment\DTOs\ShipmentDTO;
use App\Models\AuditTrail;

class UpdateShipmentAction
{
    public function execute(Shipment $model, ShipmentDTO $dto): Shipment
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'Shipments');
        $model->save();
        return $model->fresh();
    }
}