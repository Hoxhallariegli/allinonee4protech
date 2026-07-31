<?php

namespace App\Domain\ClinicManagement\Prescription\Actions;

use App\Models\ClinicManagement\Prescription;
use App\Domain\ClinicManagement\Prescription\DTOs\PrescriptionDTO;
use App\Models\AuditTrail;

class CreatePrescriptionAction
{
    public function execute(PrescriptionDTO $dto): Prescription 
    {
        $item = Prescription::create($dto->toArray());
        AuditTrail::log($item, 'create', 'Prescriptions');
        return $item;
    }
}