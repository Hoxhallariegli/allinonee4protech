<?php

namespace App\Domain\ClinicManagement\Patient\Actions;

use App\Models\ClinicManagement\Patient;
use App\Domain\ClinicManagement\Patient\DTOs\PatientDTO;
use App\Models\AuditTrail;

class UpdatePatientAction
{
    public function execute(Patient $model, PatientDTO $dto): Patient
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'Patients');
        $model->save();
        return $model->fresh();
    }
}