<?php

namespace App\Domain\FleetManagement\Shipment\Actions;

use App\Models\FleetManagement\Shipment;
use App\Domain\FleetManagement\Shipment\DTOs\ShipmentDTO;
use App\Models\AuditTrail;

class CreateShipmentAction
{
    public function execute(ShipmentDTO $dto): Shipment 
    {
        $item = Shipment::create($dto->toArray());
        AuditTrail::log($item, 'create', 'Shipments');
        return $item;
    }
}