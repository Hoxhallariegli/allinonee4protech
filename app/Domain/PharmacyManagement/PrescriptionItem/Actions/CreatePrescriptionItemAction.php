<?php

namespace App\Domain\PharmacyManagement\PrescriptionItem\Actions;

use App\Models\PharmacyManagement\PrescriptionItem;
use App\Domain\PharmacyManagement\PrescriptionItem\DTOs\PrescriptionItemDTO;
use App\Models\AuditTrail;

class CreatePrescriptionItemAction
{
    public function execute(PrescriptionItemDTO $dto): PrescriptionItem 
    {
        $item = PrescriptionItem::create($dto->toArray());
        AuditTrail::log($item, 'create', 'PrescriptionItems');
        return $item;
    }
}