<?php

namespace App\Domain\PharmacyManagement\Prescription\Actions;

use App\Models\PharmacyManagement\Prescription;
use App\Domain\PharmacyManagement\Prescription\DTOs\PrescriptionDTO;
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