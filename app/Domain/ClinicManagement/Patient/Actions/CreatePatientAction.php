<?php

namespace App\Domain\ClinicManagement\Patient\Actions;

use App\Models\ClinicManagement\Patient;
use App\Domain\ClinicManagement\Patient\DTOs\PatientDTO;
use App\Models\AuditTrail;

class CreatePatientAction
{
    public function execute(PatientDTO $dto): Patient 
    {
        $item = Patient::create($dto->toArray());
        AuditTrail::log($item, 'create', 'Patients');
        return $item;
    }
}