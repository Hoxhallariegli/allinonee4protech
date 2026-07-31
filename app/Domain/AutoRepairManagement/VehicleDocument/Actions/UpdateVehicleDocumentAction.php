<?php

namespace App\Domain\AutoRepairManagement\VehicleDocument\Actions;

use App\Models\AutoRepairManagement\VehicleDocument;
use App\Domain\AutoRepairManagement\VehicleDocument\DTOs\VehicleDocumentDTO;
use App\Models\AuditTrail;

class UpdateVehicleDocumentAction
{
    public function execute(VehicleDocument $model, VehicleDocumentDTO $dto): VehicleDocument
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'VehicleDocuments');
        $model->save();
        return $model->fresh();
    }
}