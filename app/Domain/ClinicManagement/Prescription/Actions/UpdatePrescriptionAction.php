<?php

namespace App\Domain\ClinicManagement\Prescription\Actions;

use App\Models\ClinicManagement\Prescription;
use App\Domain\ClinicManagement\Prescription\DTOs\PrescriptionDTO;
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