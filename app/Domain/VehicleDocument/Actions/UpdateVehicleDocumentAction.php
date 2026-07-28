<?php

namespace App\Domain\VehicleDocument\Actions;

use App\Models\VehicleDocument;
use App\Domain\VehicleDocument\DTOs\VehicleDocumentDTO;
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