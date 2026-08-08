<?php

namespace App\Domain\ClinicManagement\MedicalVital\Actions;

use App\Models\ClinicManagement\MedicalVital;
use App\Domain\ClinicManagement\MedicalVital\DTOs\MedicalVitalDTO;
use App\Models\AuditTrail;

class CreateMedicalVitalAction
{
    public function execute(MedicalVitalDTO $dto): MedicalVital 
    {
        $item = MedicalVital::create($dto->toArray());
        AuditTrail::log($item, 'create', 'MedicalVitals');
        return $item;
    }
}