<?php

namespace App\Domain\ClinicManagement\PatientAddress\Actions;

use App\Models\ClinicManagement\PatientAddress;
use App\Domain\ClinicManagement\PatientAddress\DTOs\PatientAddressDTO;
use App\Models\AuditTrail;

class UpdatePatientAddressAction
{
    public function execute(PatientAddress $model, PatientAddressDTO $dto): PatientAddress
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'PatientAddresses');
        $model->save();
        return $model->fresh();
    }
}