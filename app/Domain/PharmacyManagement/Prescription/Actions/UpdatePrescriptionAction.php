<?php

namespace App\Domain\PharmacyManagement\Prescription\Actions;

use App\Models\PharmacyManagement\Prescription;
use App\Domain\PharmacyManagement\Prescription\DTOs\PrescriptionDTO;
use App\Models\AuditTrail;

class UpdatePrescriptionAction
{
    public function execute(Prescription $model, PrescriptionDTO $dto): Prescription
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'Prescriptions');
        $model->save();
        return $model->fresh();
    }
}