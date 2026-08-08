<?php

namespace App\Domain\PharmacyManagement\Medicine\Actions;

use App\Models\PharmacyManagement\Medicine;
use App\Domain\PharmacyManagement\Medicine\DTOs\MedicineDTO;
use App\Models\AuditTrail;

class UpdateMedicineAction
{
    public function execute(Medicine $model, MedicineDTO $dto): Medicine
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'Medicines');
        $model->save();
        return $model->fresh();
    }
}