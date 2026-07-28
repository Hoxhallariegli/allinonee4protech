<?php

namespace App\Domain\VehicleDocument\Actions;

use App\Models\VehicleDocument;
use App\Domain\VehicleDocument\DTOs\VehicleDocumentDTO;
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