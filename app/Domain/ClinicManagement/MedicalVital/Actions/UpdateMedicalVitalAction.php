<?php

namespace App\Domain\ClinicManagement\MedicalVital\Actions;

use App\Models\ClinicManagement\MedicalVital;
use App\Domain\ClinicManagement\MedicalVital\DTOs\MedicalVitalDTO;
use App\Models\AuditTrail;

class UpdateMedicalVitalAction
{
    public function execute(MedicalVital $model, MedicalVitalDTO $dto): MedicalVital
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'MedicalVitals');
        $model->save();
        return $model->fresh();
    }
}