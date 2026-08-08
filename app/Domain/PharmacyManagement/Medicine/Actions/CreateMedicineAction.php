<?php

namespace App\Domain\PharmacyManagement\Medicine\Actions;

use App\Models\PharmacyManagement\Medicine;
use App\Domain\PharmacyManagement\Medicine\DTOs\MedicineDTO;
use App\Models\AuditTrail;

class CreateMedicineAction
{
    public function execute(MedicineDTO $dto): Medicine 
    {
        $item = Medicine::create($dto->toArray());
        AuditTrail::log($item, 'create', 'Medicines');
        return $item;
    }
}