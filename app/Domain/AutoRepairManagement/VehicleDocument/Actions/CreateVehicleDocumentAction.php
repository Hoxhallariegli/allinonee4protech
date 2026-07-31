<?php

namespace App\Domain\AutoRepairManagement\VehicleDocument\Actions;

use App\Models\AutoRepairManagement\VehicleDocument;
use App\Domain\AutoRepairManagement\VehicleDocument\DTOs\VehicleDocumentDTO;
use App\Models\AuditTrail;

class CreateVehicleDocumentAction
{
    public function execute(VehicleDocumentDTO $dto): VehicleDocument 
    {
        $item = VehicleDocument::create($dto->toArray());
        AuditTrail::log($item, 'create', 'VehicleDocuments');
        return $item;
    }
}