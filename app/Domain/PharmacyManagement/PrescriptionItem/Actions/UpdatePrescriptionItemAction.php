<?php

namespace App\Domain\PharmacyManagement\PrescriptionItem\Actions;

use App\Models\PharmacyManagement\PrescriptionItem;
use App\Domain\PharmacyManagement\PrescriptionItem\DTOs\PrescriptionItemDTO;
use App\Models\AuditTrail;

class UpdatePrescriptionItemAction
{
    public function execute(PrescriptionItem $model, PrescriptionItemDTO $dto): PrescriptionItem
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'PrescriptionItems');
        $model->save();
        return $model->fresh();
    }
}